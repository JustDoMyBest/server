from django.shortcuts import render
from django.http import *

from django.views import generic

# Create your views here.

class IndexView(generic.ListView):
    template_name = 'awesome_sharing_courses/index.html'

    def get_queryset(self):
        pass
