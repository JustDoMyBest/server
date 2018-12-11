import datetime

from django.db import models
from django.utils import timezone

# Create your models here.


class Question(models.Model):
    question_text = models.CharField(max_length=200)
    def get_question_text(self):
        return self
    get_question_text.admin_order_field = 'question_text'
    get_question_text.short_description = '问题文字'
    # pub_date = models.DateTimeField('date published')
    pub_date = models.DateTimeField('发布日期')
    def __str__(self):
        return self.question_text
        # return '问题标题'
    def was_published_recently(self):
        # return self.pub_date >= timezone.now() - datetime.timedelta(days=1)
        return timezone.now() - datetime.timedelta(days=1) <= self.pub_date <= timezone.now()
    was_published_recently.admin_order_field = 'pub_date'
    was_published_recently.boolean = True
    # was_published_recently.short_description = 'Published recently?'
    was_published_recently.short_description = '最近一天内发布?'

class Choice(models.Model):
    question = models.ForeignKey(Question,on_delete=models.CASCADE)
    choice_text = models.CharField(max_length=200)
    votes = models.IntegerField(default=0)
    def __str__(self):
        return self.choice_text
