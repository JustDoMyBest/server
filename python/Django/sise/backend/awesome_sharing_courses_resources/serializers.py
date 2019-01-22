from rest_framework import serializers
# from .models import CourseType, Course, FileType, File
from .models import *
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
        # fields = '__all__'

class GroupNameSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Group
        fields = ( 'name',)

class UserSerializer(serializers.HyperlinkedModelSerializer):
    groups = GroupNameSerializer(many=True)
    class Meta:
        model = User
        fields = ('url', 'id', 'username', 'groups')
        # fields = '__all__'

class CourseTypeSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = CourseType
        # fields = ('url', 'id', 'owner', 'type', 'show', 'mod_date')
        fields = '__all__'

class CourseSerializer(serializers.HyperlinkedModelSerializer):
    # id = serializers.IntegerField(read_only=True)
    like = serializers.IntegerField(default=0)
    dislike = serializers.IntegerField(default=0)
    class Meta:
        model = Course
        # fields = ('url', 'id', 'owner', 'type', 'show', 'tags', 'title', 'description', 'like', 'dislike', 'mod_date')
        fields = '__all__'

class ChapterSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Chapter
        fields = '__all__'

class FileTypeSerializer(serializers.HyperlinkedModelSerializer):
    # id = serializers.IntegerField(read_only=True)
    class Meta:
        model = FileType
        # fields = ('url', 'id', 'owner', 'type', 'show', 'mod_date')
        fields = '__all__'

class FileTypeTypeSerializer(serializers.HyperlinkedModelSerializer):
    # id = serializers.IntegerField(read_only=True)
    # type = serializers.
    class Meta:
        model = FileType
        # fields = ('url', 'id', 'owner', 'type', 'show', 'mod_date')
        fields = ('type',)

class FileSerializer(serializers.HyperlinkedModelSerializer):
    # id = serializers.IntegerField(read_only=True)
    # type = serializers.HyperlinkedIdentityField(view_name='file-type', format='html')
    type = FileTypeTypeSerializer(many=False, read_only=True)
    tags = serializers.CharField(required=False)
    like = serializers.IntegerField(default=0)
    dislike = serializers.IntegerField(default=0)
    # def get_type(self, obj):
    #     return obj.type.type
    class Meta:
        model = File
        # fields = ('url', 'id', 'owner', 'type', 'show', 'tags', 'file', 'like', 'dislike', 'mod_date')
        fields = '__all__'

