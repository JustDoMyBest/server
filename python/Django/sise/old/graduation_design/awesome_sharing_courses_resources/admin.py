from django.contrib import admin

from .models import *

# Register your models here.

class FileTypeAdmin(admin.ModelAdmin):
    fieldsets = [
        (None, {'fields': ['type']}),
    ]
    list_display = ['type']
    search_fields = ['type']

class FileInline(admin.StackedInline):
    model = File
    extra = 1

class CourseTypeAdmin(admin.ModelAdmin):
    fieldsets = [
        (None, {'fields': ['type']}),
    ]
    list_display = ['type']
    search_fields = ['type']

# class CourseTypeInline(admin.TabularInline):
#     model = CourseType
#     extra = 1

class CourseAdmin(admin.ModelAdmin):
    fieldsets = [

    ]
    inlines = [FileInline]

admin.site.register(FileType, FileTypeAdmin)
admin.site.register(CourseType, CourseTypeAdmin)
admin.site.register(Course, CourseAdmin)