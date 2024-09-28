from flask import (
    Blueprint, flash, g, redirect, render_template, request, url_for
)
from werkzeug.exceptions import abort

from flask_app.auth import login_required
from flask_app.db import get_db
from flask import jsonify


bp = Blueprint('scrap',__name__)


@bp.route('/')
def index():
    db = get_db()
    posts = db.execute(
        'SELECT id, author, body'
        ' FROM twitterpost'
    ).fetchall()
    return render_template('scrap/index.html', posts=posts)


@bp.route('/api/gettwpost', methods=['GET'])
@login_required
def twpost_get():
            author =request.args.get('author')
            username =request.args.get('username')
            print (author)
            print (username)
            from . import get_twitter_post
            tweets = get_twitter_post.searchtwitterprofile(author,username)    
            return jsonify(tweets)

# @login_required
# def twpost_post():
#     if request.method == 'POST':
#         author = request.form['author']
#         username = request.form['username']
#         error = None

#         if not author:
#             error = 'Author is required.'
#         if not username:
#             error = 'username is required.'

#         if error is not None:
#             flash(error)
#         else:
#             db = get_db()
#             from . import get_twitter_post
#             tweets = get_twitter_post.searchtwitterprofile(author,username)

#             for i in tweets:
#                 db.execute(
#                     'INSERT INTO twitterpost (author, body)'
#                     ' VALUES (?, ?)',
#                     (author, i)
#                 )
#                 db.commit()
#             return redirect(url_for('scrap.index'))

#     return render_template('scrap/create.html')

# def get_post(id, check_author=True):
#     post = get_db().execute(
#         'SELECT p.id, title, body, created, author_id, username'
#         ' FROM post p JOIN user u ON p.author_id = u.id'
#         ' WHERE p.id = ?',
#         (id,)
#     ).fetchone()

#     if post is None:
#         abort(404, f"Post id {id} doesn't exist.")

#     if check_author and post['author_id'] != g.user['id']:
#         abort(403)

#     return post

# @bp.route('/<int:id>/update', methods=('GET', 'POST'))
# @login_required
# def update(id):
#     post = get_post(id)

#     if request.method == 'POST':
#         title = request.form['title']
#         body = request.form['body']
#         error = None

#         if not title:
#             error = 'Title is required.'

#         if error is not None:
#             flash(error)
#         else:
#             db = get_db()
#             db.execute(
#                 'UPDATE post SET title = ?, body = ?'
#                 ' WHERE id = ?',
#                 (title, body, id)
#             )
#             db.commit()
#             return redirect(url_for('blog.index'))

#     return render_template('blog/update.html', post=post)


# @bp.route('/<int:id>/delete', methods=('POST',))
# @login_required
# def delete(id):
#     get_post(id)
#     db = get_db()
#     db.execute('DELETE FROM post WHERE id = ?', (id,))
#     db.commit()
#     return redirect(url_for('blog.index'))