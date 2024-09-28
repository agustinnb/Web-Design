from locale import currency
from django.db import models
from django.utils import timezone


class ScrapyItem(models.Model):
    unique_id = models.CharField(max_length=100, null=True)
    ticker = models.CharField(max_length=100, null=True)
    symbol = models.CharField(max_length=100, null=True)
    date = models.DateTimeField(null=True)
    title = models.TextField(blank=True,null=True)
    description = models.TextField(blank=True, null=True)
    importance = models.CharField(max_length=100, null=True)
    previous = models.CharField(max_length=100, null=True)
    forecast = models.CharField(max_length=100, null=True)
    country = models.CharField(max_length=100, null=True)
    actual = models.CharField(max_length=100, null=True)
    alldayevent = models.BooleanField(max_length=100, null=True, default=False)
    currency = models.CharField(max_length=100, null=True)
    reference = models.CharField(max_length=100, null=True)
    revised = models.TextField(blank=True)
    lastupdate = models.DateTimeField(null=True)