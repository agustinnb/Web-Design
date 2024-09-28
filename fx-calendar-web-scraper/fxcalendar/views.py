from http import HTTPStatus
from urllib.parse import urlparse
from uuid import uuid4

from django.core.exceptions import ValidationError
from django.core.validators import URLValidator
from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
from django.views.decorators.http import require_http_methods
from scrapyd_api import ScrapydAPI
from fxcalendar.models import ScrapyItem

scrapyd = ScrapydAPI('https://scrapy-fx-calendar-web-scraper.herokuapp.com')


def is_valid_url(url):
    validate = URLValidator()
    try:
        validate(url)
    except ValidationError:
        return False

    return True


class SchedulingError(Exception):
    def __str__(self):
        return 'scheduling error'

@csrf_exempt
@require_http_methods(['POST', 'GET'])
def crawl(request):
    if request.method == 'POST':
        unique_id = str(uuid4())

        settings = {
            'unique_id': unique_id,
        }
        try:
            task = scrapyd.schedule('default', 'fxcalendar', settings=settings)
        except SchedulingError as e:
            return JsonResponse(
                {'error': e},
                status=HTTPStatus.INTERNAL_SERVER_ERROR
            )
        return JsonResponse({'task_id': task, 'unique_id': unique_id, 'status': 'started'})
    elif request.method == 'GET':
        try:
            task_id = request.GET.get('task_id', None)
        except ValueError as e:
            return JsonResponse(
                {'error': e},
                status=HTTPStatus.BAD_REQUEST
            )
        try:
            unique_id = request.GET.get('unique_id', None)[:-1]
        except ValueError as e:
            return JsonResponse(
                {'error': e},
                status=HTTPStatus.BAD_REQUEST
            )
        status = scrapyd.job_status('default', task_id)
        if status == 'finished':
            try:
                item = ScrapyItem.objects.filter(unique_id=unique_id)
                if not item:
                    return JsonResponse(
                        {'error': 'There is no data'},
                        status=HTTPStatus.NOT_FOUND
                    )
                dict_list = []
                for i in list(item):
                    dict_data = {
                        'unique_id': i.Unique_id,
                        'ticker': i.ticker,
                        'symbol': i.symbol,
                        'date': i.date,
                        'title': i.title,
                        'description': i.description,
                        'importance': i.importance,
                        'lastupdate': i.lastupdate
                    }
                    dict_list.append(dict_data)
                data = {'data': dict_list}
                return JsonResponse(data)
            except Exception as e:
                return JsonResponse(
                    {'error': str(e)},
                )
        else:
            return JsonResponse({'status': status})


def show_data(request):
    item = ScrapyItem.objects.order_by('-lastupdate')[:10]
    if not item:
        return JsonResponse(
            {'error': 'There is no data in database'},
            status=HTTPStatus.NOT_FOUND
        )
    dict_list = []
    for i in list(item):
        dict_data = {
                        'unique_id': i.unique_id,
                        'ticker': i.ticker,
                        'symbol': i.symbol,
                        'date': i.date,
                        'title': i.title,
                        'description': i.description,
                        'importance': i.importance,
                        'lastupdate': i.lastupdate
        }
        dict_list.append(dict_data)
    data = {'data': dict_list}
    return JsonResponse(data)