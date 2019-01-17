from django.shortcuts import render

# Create your views here.

# from django.http import HttpResponse, JsonResponse
from django.views.decorators.csrf import csrf_exempt
from rest_framework.renderers import JSONRenderer
from rest_framework.parsers import JSONParser
from rest_framework import generics
from rest_framework.decorators import api_view
from rest_framework.response import Response
from rest_framework import status
from .models import Snippet
from .serializers import SnippetSerializer
from django.contrib.auth.models import User, Group
# from .serializers import UserSerializer, GroupSerializer
from .serializers import *
from rest_framework import permissions
from .permissions import IsOwnerOrReadOnly
from rest_framework.reverse import reverse
from rest_framework import renderers
from rest_framework.pagination import PageNumberPagination
from rest_framework import viewsets
from rest_framework.decorators import action
from rest_framework.response import Response


# @api_view(['GET'])
# def api_root(request, format=None):
#     return Response({
#         'users': reverse('user-list', request=request, format=format),
#         'groups': reverse('group-list', request=request, format=format),
#         'snippets': reverse('snippet-list', request=request, format=format)
#     })


# class SnippetHighlight(generics.GenericAPIView):
#     queryset = Snippet.objects.all()
#     renderer_classes = (renderers.StaticHTMLRenderer,)
#
#     def get(self, request, *args, **kwargs):
#         snippet = self.get_object()
#         return Response(snippet.highlighted)

# @csrf_exempt
# class SnippetList(generics.ListCreateAPIView):
#     queryset = Snippet.objects.all()
#     serializer_class = SnippetSerializer
#     permission_classes = (permissions.IsAuthenticatedOrReadOnly,)
#
#     def perform_create(self, serializer):
#         serializer.save(owner=self.request.user)


# @csrf_exempt
# class SnippetDetail(generics.RetrieveUpdateDestroyAPIView):
#     queryset = Snippet.objects.all()
#     serializer_class = SnippetSerializer
#     permission_classes = (permissions.IsAuthenticatedOrReadOnly,
#                           IsOwnerOrReadOnly,)

class SnippetViewSet(viewsets.ModelViewSet):
    """
    This viewset automatically provides `list`, `create`, `retrieve`,
    `update` and `destroy` actions.

    Additionally we also provide an extra `highlight` action.
    """
    queryset = Snippet.objects.all()
    serializer_class = SnippetSerializer
    permission_classes = (permissions.IsAuthenticatedOrReadOnly,
                          IsOwnerOrReadOnly,)

    @action(detail=True, renderer_classes=[renderers.StaticHTMLRenderer])
    def highlight(self, request, *args, **kwargs):
        snippet = self.get_object()
        return Response(snippet.highlighted)

    def perform_create(self, serializer):
        serializer.save(owner=self.request.user)

# @csrf_exempt
# class UserList(generics.ListAPIView):
# class UserList(generics.ListCreateAPIView):
#     queryset = User.objects.all()
#     serializer_class = UserSerializer


# @csrf_exempt
# class UserDetail(generics.RetrieveAPIView):
# class UserDetail(generics.RetrieveUpdateDestroyAPIView):
#     queryset = User.objects.all()
#     serializer_class = UserSerializer

# class UserViewSet(viewsets.ReadOnlyModelViewSet):
class UserViewSet(viewsets.ModelViewSet):
    """
    This viewset automatically provides `list` and `detail` actions.
    """
    queryset = User.objects.all()
    serializer_class = UserSerializer

# # @csrf_exempt
# # class GroupList(generics.ListAPIView):
# class GroupList(generics.ListCreateAPIView):
#     queryset = Group.objects.all()
#     serializer_class = GroupSerializer
#
#
# # @csrf_exempt
# # class GroupDetail(generics.RetrieveAPIView):
# class GroupDetail(generics.RetrieveUpdateDestroyAPIView):
#     queryset = Group.objects.all()
#     serializer_class = GroupSerializer

class GroupViewSet(viewsets.ModelViewSet):
    queryset = Group.objects.all()
    serializer_class = GroupSerializer

class ChapterViewSet(viewsets.ModelViewSet):
    queryset = Chapter.objects.all()
    serializer_class = ChapterSerializer

class FileViewSet(viewsets.ModelViewSet):
    queryset = File.objects.all()
    serializer_class = FileSerializer