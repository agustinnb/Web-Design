import os
from flask import Flask

def create_app(test_config=None):
    app = Flask(__name__, instance_relative_config=True)
    
    
    app.config.from_mapping(
        SECRET_KET='dev',
        DATABASE=os.path.join(app.instance_path, 'flask-selenium.sqlite')
    )
    app.secret_key='secret_key'
    if test_config is None:
        app.config.from_pyfile('config.py', silent=True)
    else:
        app.config.from_mapping(test_config)

    try:
        os.makedirs(app.instance_path)
    except OSError:
        pass
    
#    @app.route('/')
#    def hello():
#        return 'Hello, World!'

    from . import db
    db.init_app(app)

    from . import auth
    app.register_blueprint(auth.bp)

    from . import scrap
    app.register_blueprint(scrap.bp)
    app.add_url_rule('/', endpoint='index')

    return app
