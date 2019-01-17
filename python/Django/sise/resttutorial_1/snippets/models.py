from django.db import models
from pygments.lexers import get_all_lexers
from pygments.styles import get_all_styles
from pygments.lexers import get_lexer_by_name
from pygments.formatters.html import HtmlFormatter
from pygments import highlight

# Create your models here.

LEXERS = [item for item in get_all_lexers() if item[1]]
LANGUAGE_CHOICES = sorted([(item[1][0], item[0]) for item in LEXERS])
STYLE_CHOICES = sorted((item, item) for item in get_all_styles())
# print(LEXERS)
# print(LANGUAGE_CHOICES)
# print(STYLE_CHOICES)
# s_test_array=[
#     (1,2),
#     (3,4,)
# ]
# print(s_test_array[1][0])
# exit()

class Snippet(models.Model):
    owner = models.ForeignKey('auth.User', related_name='snippets', on_delete=models.CASCADE)
    highlighted = models.TextField()

    created = models.DateTimeField(auto_now_add=True)
    title = models.CharField(max_length=100, blank=True, default='')
    code = models.TextField()
    linenos = models.BooleanField(default=False)
    language = models.CharField(choices=LANGUAGE_CHOICES, default='python', max_length=100)
    style = models.CharField(choices=STYLE_CHOICES, default='friendly', max_length=100)

    class Meta:
        ordering = ('created',)

    def save(self, *args, **kwargs):
        """
        Use the `pygments` library to create a highlighted HTML
        representation of the code snippet.
        """
        lexer = get_lexer_by_name(self.language)
        linenos = 'table' if self.linenos else False
        options = {'title': self.title} if self.title else {}
        formatter = HtmlFormatter(style=self.style, linenos=linenos,
                                  full=True, **options)
        self.highlighted = highlight(self.code, lexer, formatter)
        super(Snippet, self).save(*args, **kwargs)

    def __str__(self):
        if self.title == '':
            return self.code
        return self.title

class Chapter(models.Model):
    owner = models.ForeignKey('auth.User', related_name='chapters', on_delete=models.CASCADE)
    snippet = models.ForeignKey('Snippet', related_name='chapters', on_delete=models.CASCADE)
    title = models.CharField(max_length=100, blank=True, default='')

    def __str__(self):
        return self.title


class File(models.Model):
    owner = models.ForeignKey('auth.User', related_name='files', on_delete=models.CASCADE)
    chapter = models.ForeignKey('Chapter', related_name='files', on_delete=models.CASCADE)
    file = models.FileField(upload_to='files/')
    title = models.CharField(max_length=100, blank=True, default='')

    def __str__(self):
        return self.title
