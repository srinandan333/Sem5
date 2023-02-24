import mysql.connector
import streamlit as st
import pandas as pd
import plotly.express as px

mydb = mysql.connector.connect(
    host='localhost',
    user='root',
    password=''
)

c = mydb.cursor()
c.execute('CREATE DATABASE IF NOT EXISTS lab10')
c.execute('use lab10')
c.execute("""CREATE TABLE IF NOT EXISTS train (Train_no int(11) PRIMARY KEY,
                    Name varchar(255),
                    Train_Type varchar(255),
                    Source varchar(255),
                    Destination varchar(255),
                    Availability varchar(3))""")

def add_data(train_num, train_name, train_type, src, dst, availability):
    c.execute(f"""INSERT INTO train VALUES({train_num},'{train_name}', '{train_type}', '{src}', '{dst}', '{availability}')""")
    mydb.commit()

def create():
    col1, col2 = st.columns(2)

    with col1:
        train_num = st.text_input("Train Number:")
        train_name = st.text_input("Train Name:")

    with col2:
        train_type = st.selectbox("Type", ['Superfast','Fast','Mail'])
        src = st.selectbox("Source", ["Bengaluru", "Chennai", "Mangaluru"])
        dst = st.selectbox("Destination", ["Bengaluru", "Chennai", "Mangaluru"])

    availability = st.selectbox("Availability", ["Yes","No"])
    if st.button("Add Train"):
        add_data(train_num, train_name, train_type, src, dst, availability)
        st.success("Successfully added Dealer: {}".format(train_name))

def view_all_data():
    c.execute('SELECT * FROM train')
    return c.fetchall()

def read():
    result = view_all_data()
    df = pd.DataFrame(result, columns=['Train_no', 'Name', 'Train_Type', 'Source', 'Destination', 'Availability'])
    with st.expander("View all Trains"):
        st.dataframe(df)

    with st.expander("Source"):
        task_df = df['Source'].value_counts().to_frame()
        task_df = task_df.reset_index()
        st.dataframe(task_df)
        p1 = px.pie(task_df, names='index', values='Source')
        st.plotly_chart(p1) 

def view_only_train_names():
    c.execute('SELECT train_no FROM Train')
    data = c.fetchall()
    return data

def get_train(train):
    c.execute('SELECT * FROM Train WHERE Train_no="{}"'.format(train))
    data = c.fetchall()
    return data

def edit_train_data(new_train_num,new_train_name,new_train_type,new_src,new_dst,new_availability,train_no,train_name,train_type,src,dst,availability):
    c.execute("UPDATE Train SET Train_no=%s, name=%s, Train_Type=%s, source=%s, destination=%s, availability=%s WHERE train_no=%s AND name=%s AND train_type=%s AND source=%s AND destination=%s AND availability=%s",
     (new_train_num,new_train_name,new_train_type,new_src,new_dst,new_availability,train_no,train_name,train_type,src,dst,availability))
    mydb.commit()

def update():
    result = view_all_data()
    df = pd.DataFrame(result, columns=['Train_no', 'Name', 'Train_Type', 'Source', 'Destination', 'Availability'])
    with st.expander("Current Trains"):
        st.dataframe(df)

    list_of_trains = [i[0] for i in view_only_train_names()]
    selected_dealer = st.selectbox("Train to Edit", list_of_trains)
    selected_result = get_train(selected_dealer)

    if selected_result:
        train_no = selected_result[0][0]
        train_name = selected_result[0][1]
        train_type = selected_result[0][2]
        src = selected_result[0][3]
        dst = selected_result[0][4]
        availability = selected_result[0][5]

        d1 = {"Bengaluru":0, "Chennai":1, "Mangaluru":2}
        d2 = {'Yes':0,'No':1}
        d3 = {'Superfast':0,'Fast':1,'Mail':2}
        col1, col2 = st.columns(2)

        with col1:
            new_train_num = st.text_input("Train Number:", train_no)
            new_train_name = st.text_input("Name:", train_name)

        with col2:
            new_train_type = st.selectbox("Type", ['Superfast','Fast','Mail'], index = d3[train_type])
            new_src = st.selectbox("Source", ["Bengaluru", "Chennai", "Mangaluru"], index = d1[src])
            new_dst = st.selectbox("Destination", ["Bengaluru", "Chennai", "Mangaluru"], index = d1[dst])
            
        new_availability = st.selectbox("Availability", ["Yes","No"], index = d2[availability])
        if st.button("Update Train Details"):
            edit_train_data(new_train_num,new_train_name,new_train_type,new_src,new_dst,new_availability,train_no,train_name,train_type,src,dst,availability)
            st.success("Successfully updated:: {} to ::{}".format(train_no, new_train_num))

    result2 = view_all_data()
    df2 = pd.DataFrame(result2, columns=['Train_no', 'Name', 'Train_Type', 'Source', 'Destination', 'Availability'])
    with st.expander("Updated data"):
        st.dataframe(df2) 

def delete_data(train_name):
    c.execute(f'DELETE FROM TRAIN WHERE train_no="{train_name}"')
    mydb.commit()

def delete():
    result = view_all_data()
    df = pd.DataFrame(result, columns=['Train_no', 'Name', 'Train_Type', 'Source', 'Destination', 'Availability'])
    with st.expander("Current data"):
        st.dataframe(df)

    list_of_trains = [i[0] for i in view_only_train_names()]
    selected_train = st.selectbox("Task to Delete", list_of_trains)
    st.warning("Do you want to delete ::{}".format(selected_train))

    if st.button("Delete Train"):
        delete_data(selected_train)
        st.success("Train has been deleted successfully")

    new_result = view_all_data()
    df2 = pd.DataFrame(new_result, columns=['Train_no', 'Name', 'Train_Type', 'Source', 'Destination', 'Availability'])
    with st.expander("Updated data"):
        st.dataframe(df2) 

def main():
    st.title("Railway Reservation System 596")
    menu = ["Add", "View", "Edit", "Remove"]
    choice = st.sidebar.selectbox("Menu", menu)

    if choice == "Add":
        st.subheader("Enter Train Details:")
        create()

    elif choice == "View":
        st.subheader("View entered train details")
        read()

    elif choice == "Edit":
        st.subheader("Update availability of trains")
        update()

    elif choice == "Remove":
        st.subheader("Delete train details")
        delete()

    else:
        st.subheader("About train")

if __name__ == '__main__':
    main()