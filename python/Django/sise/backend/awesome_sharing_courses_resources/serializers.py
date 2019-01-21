from rest_framework import serializers
from .models import CourseType, Course, FileType, File
from django.contrib.auth.models import User, Group


# class CourseTypeSerializer(serializers.Serializer):
#     id = serializers.IntegerField(read_only=True)
#     type = serializers.CharField(required=True, max_length=255, verbose_name='课程类型', help_text='课程类型')
#     show = serializers.BooleanField(required=False, verbose_name='显示', help_text='显示')
#
#     def create(self, validated_data):
#         """
#         Create and return a new `CourseType` instance, given the validated data.
#         """
#         return CourseType.objects.create(**validated_data)
#
#     def update(self, instance, validated_data):
#         """
#         Update and return an existing `CourseType` instance, given the validated data.
#         """
#         instance.type = validated_data.get('type', instance.type)
#         instance.show = validated_data.get('show', instance.show)
#         instance.save()
#         return instance

class GroupSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Group
        fields = ('url', 'id', 'name', 'user_set')

class GroupNameSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Group
        fields = ( 'name',)

class UserSerializer(serializers.HyperlinkedModelSerializer):
    groups = GroupNameSerializer(many=True)
    class Meta:
        model = User
        fields = ('url', 'id', 'username', 'groups', 'mod_date')

class CourseTypeSerializer(serializers.ModelSerializer):
    class Meta:
        model = CourseType
        fields = ('url', 'id', 'owner', 'type', 'show', 'mod_date')


class CourseSerializer(serializers.Serializer):
    # id = serializers.IntegerField(read_only=True)
    class Meta:
        model = Course
        fields = ('url', 'id', 'owner', 'type', 'show', 'tags', 'title', 'description', 'like', 'dislike', 'mod_date')


class FileTypeSerializer(serializers.Serializer):
    # id = serializers.IntegerField(read_only=True)
    class Meta:
        model = FileType
        fields = ('url', 'id', 'owner', 'type', 'show', 'mod_date')


class FileSerializer(serializers.Serializer):
    # id = serializers.IntegerField(read_only=True)
    class Meta:
        model = File
        fields = ('url', 'id', 'owner', 'type', 'show', 'tags', 'file', 'like', 'dislike', 'mod_date')

