from django.db import models

# Create your models here.

class Course(models.Model):
    type = models.CharField(max_length=255)
    tags = models.CharField(max_length=65535)
    title = models.CharField(max_length=65535)
    description = models.CharField(max_length=65535)

#############
# Resources #
#############
# class Media(models.Model):
#     type = models.CharField(max_length=255)
#     tags = models.CharField(max_length=65535)
#     url = models.CharField(max_length=65535)
#
# class Image(models.Model):
#     type = models.CharField(max_length=255)
#     tags = models.CharField(max_length=65535)
#     url = models.CharField(max_length=65535)
#
class FileType(models.Model):
    type = models.CharField(max_length=255)
class File(models.Model):
    course = models.ForeignKey(Course, on_delete=models.CASCADE)
    type = models.ForeignKey(FileType, on_delete=models.CASCADE)
    tags = models.CharField(max_length=65535)
    url = models.CharField(max_length=65535)
