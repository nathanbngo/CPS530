from flask import Flask, send_from_directory
import os

app = Flask(__name__)

# Define the path to the lab10 directory
BASE_DIR = os.path.dirname(os.path.abspath(__file__))

@app.route("/")
def home():
    # Serve the index.html file from the lab10 directory
    return send_from_directory(BASE_DIR, "index.html")

if __name__ == "__main__":
    app.run(debug=True)
