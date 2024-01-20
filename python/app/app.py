#!/usr/bin/env python
# -*- coding: utf-8 -*-

from flask import Flask, render_template, g, request, redirect, url_for,  make_response
import logging, psycopg2
import time
import bcrypt


app = Flask(__name__)




@app.route("/")
def home():
    return render_template("index.html");



@app.route("/part1.html", methods=['GET'])
def login():


    return render_template("part1.html");



@app.route("/part1_vulnerable", methods=['GET', 'POST'])
def part1_vulnerable():
    logger.info("---- part1_vulnerable ----")

    if request.method == 'GET':
        password = request.args.get('v_password') 
        username = request.args.get('v_username') 
        remember = request.args.get('v_remember') 
    else:
        password = request.form['v_password']
        username = request.form['v_username']
        remember = request.form['v_remember']
        
    

    logger.info("v_password  -> " + password);
    logger.info("v_username  -> " + username);
    logger.info("v_remember  -> " + remember);


    return "/part1_vulnerable "


@app.route("/part1_correct", methods=['GET', 'POST'])
def part1_correct():
    


    return "/part1_correct"



@app.route("/part2.html", methods=['GET'])
def part2():



    return render_template("part2.html");


@app.route("/part2_vulnerable", methods=['GET', 'POST'])
def part2_vulnerable():
    
   

    return "/part2_vulnerable"


@app.route("/part2_correct", methods=['GET', 'POST'])
def part2_correct():
    

    return "/part2_correct"



@app.route("/demo", methods=['GET', 'POST'])
def demo():
    logger.info("\n DEMO \n");   

    conn = get_db()
    cur = conn.cursor()

    logger.info("---- users  ----")
    cur.execute("SELECT * FROM users")
    rows = cur.fetchall()

    for row in rows:
        logger.info(row)

    for row in rows:
        logger.info(row)

    logger.info("---- messages ----")
    cur.execute("SELECT * FROM messages")
    rows = cur.fetchall()
 
    for row in rows:
        logger.info(row)

    conn.close ()
    logger.info("\n---------------------\n\n") 

    return "/demo"


##########################################################
## DATABASE ACCESS
##########################################################

def get_db():
    db = psycopg2.connect(user = "ss-db-a1",
                password = "ss-db-a1",
                host = "db",
                port = "5432",
                database = "ss-db-a1")
    return db





##########################################################
## MAIN
##########################################################
if __name__ == "__main__":
    logging.basicConfig(filename="logs/log_file.log")

    logger = logging.getLogger('logger')
    logger.setLevel(logging.DEBUG)
    ch = logging.StreamHandler()
    ch.setLevel(logging.DEBUG)

    # create formatter
    formatter = logging.Formatter('%(asctime)s [%(levelname)s] %(name)s:  %(message)s')

    # add formatter to ch
    ch.setFormatter(formatter)

    # add ch to logger
    logger.addHandler(ch)

    logger.info("\n---------BCRYPT------------\n\n")
    
    
    
    # >>> import bcrypt
    # >>> password = b"super secret password"
    # >>> # Hash a password for the first time, with a randomly-generated salt
    # >>> hashed = bcrypt.hashpw(password, bcrypt.gensalt())
    # >>> # Check that an unhashed password matches one that has previously been
    # >>> # hashed
    # >>> if bcrypt.checkpw(password, hashed):
    # ...     print("It Matches!")
    # ... else:
    # ...     print("It Does not Match :(")
    
    
    password = b"super secret password"
    
    
    # Hash a password for the first time, with a randomly-generated salt
    hashed = bcrypt.hashpw(password, bcrypt.gensalt()) #hash da pwd
    
    logger.info("HASHED ")
    logger.info(hashed)
    
    if bcrypt.checkpw(b"password errada", hashed):
        logger.info("(E)It Matches!")
    else:
        logger.info("(E)It Does not Match :(")
    
    if bcrypt.checkpw(password, hashed):
        logger.info("(C)It Matches!")
    else:
        logger.info("(C)It Does not Match :(")
    
    
    
    
    # time.sleep(1)

    conn = get_db()
    cur = conn.cursor()


    logger.info("---- users  ----")
    cur.execute("SELECT * FROM users")
    rows = cur.fetchall()

    for row in rows:
        logger.info(row)



    logger.info("---- users  ---- foobartee")
    cur.execute("SELECT * FROM users where username = %s", ("foobartee",))
    rows = cur.fetchall()

    for row in rows:
        logger.info(row)



    logger.info("---- users  ---- foobar")
    cur.execute("SELECT * FROM users where username = %s", ("foobar",))
    rows = cur.fetchall()

    for row in rows:
        logger.info(row)


    logger.info("---- users  ---- %foobar%")
    cur.execute("SELECT * FROM users where username LIKE %s", ("%foobar%",))
    rows = cur.fetchall()

    for row in rows:
        logger.info(row)
    

    app.run(host="0.0.0.0", debug=True, threaded=True)

#SELECT * FROM users where username LIKE \'%%s%\'", ("foobar",)



