# Generated by Django 2.1.3 on 2018-12-14 02:28

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Course',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('tags', models.CharField(help_text='课程标签个数不限，以空格间隔。例子：标签1 标签2 标签3 标签4', max_length=65535, verbose_name='课程标签')),
                ('title', models.CharField(help_text='课程标题', max_length=6553, verbose_name='课程标题')),
                ('description', models.CharField(help_text='课程描述', max_length=65535, verbose_name='课程描述')),
                ('like', models.CharField(help_text='课程点赞数', max_length=65535, verbose_name='课程点赞数')),
                ('dislike', models.CharField(help_text='课程踩数', max_length=65535, verbose_name='课程踩数')),
                ('pub_date', models.DateTimeField(auto_now_add=True, help_text='发布日期时间', verbose_name='发布日期时间')),
                ('mod_date', models.DateTimeField(auto_now=True, help_text='修改日期时间', verbose_name='修改日期时间')),
            ],
            options={
                'verbose_name': '课程',
                'verbose_name_plural': '课程',
            },
        ),
        migrations.CreateModel(
            name='CourseType',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('type', models.CharField(help_text='课程类型', max_length=255, verbose_name='课程类型')),
                ('pub_date', models.DateTimeField(auto_now_add=True, help_text='发布日期时间', verbose_name='发布日期时间')),
                ('mod_date', models.DateTimeField(auto_now=True, help_text='修改日期时间', verbose_name='修改日期时间')),
            ],
            options={
                'verbose_name': '课程类型',
                'verbose_name_plural': '课程类型',
            },
        ),
        migrations.CreateModel(
            name='File',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('tags', models.CharField(help_text='文件标签', max_length=65535, verbose_name='文件标签')),
                ('uri', models.CharField(help_text='文件存放uri', max_length=65535, verbose_name='文件存放uri')),
                ('like', models.CharField(help_text='文件点赞数', max_length=65535, verbose_name='文件点赞数')),
                ('dislike', models.CharField(help_text='文件踩数', max_length=65535, verbose_name='文件踩数')),
                ('pub_date', models.DateTimeField(auto_now_add=True, help_text='发布日期时间', verbose_name='发布日期时间')),
                ('mod_date', models.DateTimeField(auto_now=True, help_text='修改日期时间', verbose_name='修改日期时间')),
                ('course', models.ForeignKey(help_text='文件所属课程', on_delete=django.db.models.deletion.CASCADE, to='awesome_sharing_courses_resources.Course', verbose_name='文件所属课程')),
            ],
            options={
                'verbose_name': '文件',
                'verbose_name_plural': '文件',
            },
        ),
        migrations.CreateModel(
            name='FileType',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('type', models.CharField(help_text='文件类型', max_length=255, verbose_name='文件类型')),
                ('pub_date', models.DateTimeField(auto_now_add=True, help_text='发布日期时间', verbose_name='发布日期时间')),
                ('mod_date', models.DateTimeField(auto_now=True, help_text='修改日期时间', verbose_name='修改日期时间')),
            ],
            options={
                'verbose_name': '文件类型',
                'verbose_name_plural': '文件类型',
            },
        ),
        migrations.AddField(
            model_name='file',
            name='type',
            field=models.ForeignKey(help_text='文件类型', on_delete=django.db.models.deletion.CASCADE, to='awesome_sharing_courses_resources.FileType', verbose_name='文件类型'),
        ),
        migrations.AddField(
            model_name='course',
            name='type',
            field=models.ForeignKey(help_text='课程类型', on_delete=django.db.models.deletion.CASCADE, to='awesome_sharing_courses_resources.CourseType', verbose_name='课程类型'),
        ),
    ]