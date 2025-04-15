from flask import Flask, render_template
import MySQLdb

app = Flask(__name__)

db = MySQLdb.connect(
    host="punyadaffa.my.id",
    user="punyada1_admin1",
    passwd="punyadaffa1",
    db="punyada1_treealgae"
)

@app.route('/')
def index():
    cursor = db.cursor(MySQLdb.cursors.DictCursor)
    cursor.execute("SELECT * FROM nama_tabel_kamu")
    data = cursor.fetchall()
    return render_template('index.html', data=data)

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/history')
def history():
    cursor = db.cursor()
    cursor.execute("SELECT * FROM nama_tabel_historis")
    history_data = cursor.fetchall()
    return render_template('history.html', data=history_data)

if __name__ == '__main__':
    app.run(debug=True)
