from django.shortcuts import render
from django.http import *

from django.views import generic
from .models import *

# Create your views here.

class IndexView(generic.ListView):
    template_name = 'awesome_sharing_courses_resources/index.html'

    def get_queryset(self):
        pass

    def get_context_data(self, *, object_list=None, **kwargs):
        context = super().get_context_data(**kwargs)
        context['FileTypes'] = CourseType.objects.all()
        return context;

class AboutView(generic.TemplateView):
    template_name = 'awesome_sharing_courses_resources/about.html'

class ContactView(generic.TemplateView):
    template_name = 'awesome_sharing_courses_resources/contact.html'

class UploadView(generic.TemplateView):
    template_name = 'awesome_sharing_courses_resources/upload-form.html'