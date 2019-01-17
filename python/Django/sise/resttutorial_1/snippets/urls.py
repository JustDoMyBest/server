from django.urls import path, include
from . import views_decorators
from . import views
from django.views.decorators.csrf import csrf_exempt
# from .views import SnippetViewSet, UserViewSet, api_root
from .views import SnippetViewSet, UserViewSet
from rest_framework import renderers
from rest_framework.routers import DefaultRouter
from django.conf import settings
from django.conf.urls.static import static

# urlpatterns = [
#     # path('snippets/', views.snippet_list),
#     # path('snippets/<int:pk>/', views.snippet_detail),
#     # path('snippets/', views_decorators.snippet_list),
#     # path('snippets/<int:pk>/', views_decorators.snippet_detail),
#
#     path('snippets/', views.SnippetList.as_view(), name = 'snippet-list'),
#     path('snippets/<int:pk>/', views.SnippetDetail.as_view(), name = 'snippet-detail'),
#     path('users/', views.UserList.as_view(), name = 'user-list'),
#     path('users/<int:pk>/', views.UserDetail.as_view(), name = 'user-detail'),
#     path('groups/', views.GroupList.as_view(), name = 'group-list'),
#     path('groups/<int:pk>/', views.GroupDetail.as_view(), name = 'group-detail'),
#     path('api-auth/', include('rest_framework.urls')),
#     path('', views.api_root),
#     path('snippets/<int:pk>/highlight/', views.SnippetHighlight.as_view(), name = 'snippet-highlight'),
# ]

# snippet_list = SnippetViewSet.as_view({
#     'get': 'list',
#     'post': 'create'
# })
# snippet_detail = SnippetViewSet.as_view({
#     'get': 'retrieve',
#     'put': 'update',
#     'patch': 'partial_update',
#     'delete': 'destroy'
# })
# snippet_highlight = SnippetViewSet.as_view({
#     'get': 'highlight'
# }, renderer_classes=[renderers.StaticHTMLRenderer])
# user_list = UserViewSet.as_view({
#     'get': 'list'
# })
# user_detail = UserViewSet.as_view({
#     'get': 'retrieve'
# })


# Create a router and register our viewsets with it.
router = DefaultRouter()
router.register(r'snippets', views.SnippetViewSet)
router.register(r'users', views.UserViewSet)
router.register(r'groups', views.GroupViewSet)
router.register(r'chapters', views.ChapterViewSet)
router.register(r'files', views.FileViewSet)

# The API URLs are now determined automatically by the router.
urlpatterns = [
    path('', include(router.urls)),
] + static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)