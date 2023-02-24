#!/bin/sh
CONVERGE=1
ITER=1
rm w w1 log*

$HADOOP_HOME/bin/hadoop dfsadmin -safemode leave
hdfs dfs -rm -r /Task1/task-* 

hadoop jar $HADOOP_HOME/share/hadoop/tools/lib/hadoop-streaming-3.3.3.jar \
-mapper "'/home/pes1ug20cs596/Task1/mapper.py'" \
-reducer "'/home/pes1ug20cs596/Task1/reducer.py' '/home/pes1ug20cs596/Task1/w'"  \
-input /Task1/web-Google.txt \
-output /Task1/task-1-output

while [ "$CONVERGE" -ne 0 ]
do
	echo "############################# ITERATION $ITER #############################"
	hadoop jar $HADOOP_HOME/share/hadoop/tools/lib/hadoop-streaming-3.3.3.jar \
	-mapper "'/home/pes1ug20cs596/Task2/mapper.py' '/home/pes1ug20cs596/Task1/w' '/home/pes1ug20cs596/Task2/page_embeddings.json'" \
	-reducer "'/home/pes1ug20cs596/Task2/reducer.py'" \
	-input /Task1/task-1-output/part-00000 \
	-output /Task1/task-2-output
	touch w1
	hadoop dfs -cat /Task1/task-2-output/part-00000 > "/home/pes1ug20cs596/Task2/w1"
	CONVERGE=$(python3 /home/pes1ug20cs596/Task2/check_conv.py $ITER>&1)
	ITER=$((ITER+1))
	hdfs dfs -rm -r /Task1/task-2-output
	echo $CONVERGE
done
