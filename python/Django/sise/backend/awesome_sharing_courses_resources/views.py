from django.shortcuts import render
from rest_framework import viewsets
from django.contrib.auth.models import User, Group
from .serializers import *
from .models import CourseType, Course, FileType, File
from rest_framework.decorators import action
from rest_framework.response import Response
from rest_framework import renderers

# Create your views here.


class UserViewSet(viewsets.ModelViewSet):
    """
    This viewset automatically provides `list` and `detail` actions.
    """
    queryset = User.objects.all()
    serializer_class = UserSerializer
class GroupViewSet(viewsets.ModelViewSet):
    queryset = Group.objects.all()
    serializer_class = GroupSerializer

class CourseTypeViewSet(viewsets.ModelViewSet):
    queryset = CourseType.objects.all()
    serializer_class = CourseTypeSerializer
class CourseViewSet(viewsets.ModelViewSet):
    queryset = Course.objects.all()
    serializer_class = CourseSerializer

class ChapterViewSet(viewsets.ModelViewSet):
    queryset = Chapter.objects.all()
    serializer_class = ChapterSerializer

class FileTypeViewSet(viewsets.ModelViewSet):
    queryset = FileType.objects.all()
    serializer_class = FileTypeSerializer
class FileViewSet(viewsets.ModelViewSet):
    queryset = File.objects.all()
    serializer_class = FileSerializer
    @action(methods=['get'], detail=True, renderer_classes=[renderers.StaticHTMLRenderer])
    def getType(self, request, *args, **kwargs):
        file = self.get_object()
        return Response(file.type.type)
