from django.db import models

# Create your models here.

# class MyModel(models.Model):
#     pass
#     class Meta:
#         app_label = 'My APP name'

class CourseType(models.Model):
    # app_label = 'myapp'
    # 《 ForeignKey
    owner = models.ForeignKey('auth.User', related_name='course_types', on_delete=models.CASCADE)
    # 》 ForeignKey
    pub_date = models.DateTimeField(auto_now_add = True, blank=False, verbose_name='发布日期时间', help_text='发布日期时间')
    mod_date = models.DateTimeField(auto_now = True, blank=False, verbose_name='修改日期时间', help_text='修改日期时间')
    type = models.CharField(max_length=255, verbose_name='课程类型', help_text='课程类型')
    show = models.BooleanField(default=False, verbose_name='显示', help_text='显示')
    def __str__(self):
        return self.type
    class Meta:
        ordering = ('mod_date',)
        verbose_name = "课程类型"
        verbose_name_plural = "课程类型"
class Course(models.Model):
    # 《 ForeignKey
    owner = models.ForeignKey('auth.User', related_name='courses', on_delete=models.CASCADE)
    type = models.ForeignKey(CourseType, related_name='courses', on_delete=models.CASCADE, verbose_name='课程类型', help_text='课程类型')
    # 》 ForeignKey
    pub_date = models.DateTimeField(auto_now_add = True, blank=False, verbose_name='发布日期时间', help_text='发布日期时间')
    mod_date = models.DateTimeField(auto_now = True, blank=False, verbose_name='修改日期时间', help_text='修改日期时间')
    # type = models.CharField(max_length=255, verbose_name='课程类型', help_text='课程类型')
    show = models.BooleanField(default=False, verbose_name='显示', help_text='显示')
    tags = models.CharField(max_length=65535, verbose_name='课程标签', help_text='课程标签个数不限，以空格间隔。<hr>例：标签1 标签2 标签3 标签4')
    title = models.CharField(max_length=6553, verbose_name='课程标题', help_text='课程标题')
    description = models.CharField(max_length=65535, verbose_name='课程描述', help_text='课程描述')
    like = models.CharField(max_length=65535, editable=False, verbose_name='课程点赞数', help_text='课程点赞数')
    dislike = models.CharField(max_length=65535, editable=False, verbose_name='课程踩数', help_text='课程踩数')
    def __str__(self):
        return self.title
    class Meta:
        ordering = ('mod_date',)
        verbose_name = "课程"
        verbose_name_plural = "课程"

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
class Chapter(models.Model):
    # 《 ForeignKey
    owner = models.ForeignKey('auth.User', related_name='chapters', on_delete=models.CASCADE)
    course = models.ForeignKey(Course, related_name='chapters', on_delete=models.CASCADE, verbose_name='章节所属课程', help_text='章节所属课程')
    # 》 ForeignKey
    pub_date = models.DateTimeField(auto_now_add = True, blank=False, verbose_name='发布日期时间', help_text='发布日期时间')
    mod_date = models.DateTimeField(auto_now = True, blank=False, verbose_name='修改日期时间', help_text='修改日期时间')
    title = models.CharField(max_length=65535, verbose_name='章节标题', help_text='章节标题')
    summary = models.CharField(max_length=65535, verbose_name='章节内容摘要', help_text='章节内容摘要')
    def __str__(self):
        return self.title
    class Meta:
        ordering = ('mod_date',)
        verbose_name = "章节"
        verbose_name_plural = "章节"
class FileType(models.Model):
    # app_label = 'myapp'
    # 《 ForeignKey
    owner = models.ForeignKey('auth.User', related_name='file_types', on_delete=models.CASCADE)
    # 》 ForeignKey
    pub_date = models.DateTimeField(auto_now_add = True, blank=False, verbose_name='发布日期时间', help_text='发布日期时间')
    mod_date = models.DateTimeField(auto_now = True, blank=False, verbose_name='修改日期时间', help_text='修改日期时间')
    show = models.BooleanField(default=False, verbose_name='显示', help_text='显示')
    type = models.CharField(max_length=255, verbose_name='文件类型', help_text='文件类型')
    def __str__(self):
        return self.type
    class Meta:
        ordering = ('mod_date',)
        verbose_name = "文件类型"
        verbose_name_plural = "文件类型"
class File(models.Model):
    # 《 ForeignKey
    owner = models.ForeignKey('auth.User', related_name='files', on_delete=models.CASCADE)
    chapter = models.ForeignKey(Course, related_name='files', on_delete=models.CASCADE, verbose_name='文件所属章节', help_text='文件所属章节')
    type = models.ForeignKey(FileType, related_name='files', on_delete=models.CASCADE, verbose_name='文件类型', help_text='文件类型')
    # 》 ForeignKey
    pub_date = models.DateTimeField(auto_now_add = True, blank=False, verbose_name='发布日期时间', help_text='发布日期时间')
    mod_date = models.DateTimeField(auto_now = True, blank=False, verbose_name='修改日期时间', help_text='修改日期时间')
    show = models.BooleanField(default=False, verbose_name='显示', help_text='显示')
    tags = models.CharField(max_length=65535, verbose_name='文件标签', help_text='文件标签个数不限，以空格间隔。<hr>例：标签1 标签2 标签3 标签4')
    # uri = models.CharField(max_length=65535, verbose_name='文件存放uri', help_text='文件存放uri')
    file = models.FileField(upload_to='file/')
    like = models.IntegerField(verbose_name='文件点赞数', help_text='文件点赞数')
    dislike = models.IntegerField(verbose_name='文件踩数', help_text='文件踩数')
    def __str__(self):
        return self.course.title
    class Meta:
        ordering = ('mod_date',)
        verbose_name = "文件"
        verbose_name_plural = "文件"
