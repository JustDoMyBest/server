from rest_framework import serializers
# from .models import Snippet, LANGUAGE_CHOICES, STYLE_CHOICES, Chapter, File
from .models import *
from django.contrib.auth.models import User,Group


# class SnippetSerializer(serializers.Serializer):
#     id = serializers.IntegerField(read_only=True)
#     title = serializers.CharField(required=False, allow_blank=True, max_length=100)
#     code = serializers.CharField(style={'base_template': 'textarea.html'})
#     linenos = serializers.BooleanField(required=False)
#     language = serializers.ChoiceField(choices=LANGUAGE_CHOICES, default='python')
#     style = serializers.ChoiceField(choices=STYLE_CHOICES, default='friendly')
#
#     def create(self, validated_data):
#         """
#         Create and return a new `Snippet` instance, given the validated data.
#         """
#         return Snippet.objects.create(**validated_data)
#
#     def update(self, instance, validated_data):
#         """
#         Update and return an existing `Snippet` instance, given the validated data.
#         """
#         instance.title = validated_data.get('title', instance.title)
#         instance.code = validated_data.get('code', instance.code)
#         instance.linenos = validated_data.get('linenos', instance.linenos)
#         instance.language = validated_data.get('language', instance.language)
#         instance.style = validated_data.get('style', instance.style)
#         instance.save()
#         return instance

class SnippetSerializer(serializers.HyperlinkedModelSerializer):
    owner = serializers.ReadOnlyField(source='owner.username')
    highlight = serializers.HyperlinkedIdentityField(view_name='snippet-highlight', format='html')

    class Meta:
        model = Snippet
        fields = ('url', 'id', 'highlight', 'owner', 'title', 'code', 'linenos', 'language', 'style')

class GroupSerializer(serializers.HyperlinkedModelSerializer):
    # user_set = serializers.HyperlinkedRelatedField(many=True, view_name='user-detail', read_only=True)

    class Meta:
        model = Group
        fields = ('url', 'id', 'name', 'user_set')

class GroupNameSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Group
        fields = ( 'name',)

class UserSerializer(serializers.HyperlinkedModelSerializer):
    snippets = serializers.HyperlinkedRelatedField(many=True, view_name='snippet-detail', read_only=True)
    # groups = serializers.HyperlinkedRelatedField(many=True, view_name='group-list', read_only=True)
    # groups = serializers.HyperlinkedIdentityField(many=True, view_name='group-list')
    groups = GroupNameSerializer(many=True)
    # groups2 = serializers.ReadOnlyField(source='groups')

    class Meta:
        model = User
        fields = ('url', 'id', 'username', 'groups', 'snippets')

class ChapterSerializer(serializers.HyperlinkedModelSerializer):
    title = serializers.CharField(required=True)
    class Meta:
        model = Chapter
        fields = ('url', 'id', 'owner', 'snippet', 'title', 'files')

class FileSerializer(serializers.HyperlinkedModelSerializer):
    title = serializers.CharField(required=True)
    class Meta:
        model = File
        fields = ('url', 'id', 'owner', 'chapter', 'file', 'title')