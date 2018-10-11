from django.shortcuts import render
from django.http import HttpResponse
from . import models


# Create your views here.
def index(request):
    # return HttpResponse('Hello, world!!')

    try:
        article = models.Article.objects.get(pk=1)
    except:
        pass
    articles = models.Article.objects.all()
    return render(request, 'blog/index.html', {
        'hello': 'Hello, Blog!!',
        'article': article,
        'articles': articles
    })


def article_page(request, article_id):
    article = models.Article.objects.get(pk=article_id)
    return render(request, 'blog/article_page.html', {'article': article})


def edit_page(request, article_id):
    if article_id and str(article_id) == '0':
        return render(request, 'blog/edit_page.html')

    try:
        article = models.Article.objects.get(pk=article_id)
        return render(request, 'blog/edit_page.html', {'article': article})
    except:
        pass
    return index(request)


def edit_action(request):
    id = str(request.POST.get('id'))
    title = request.POST.get('title', 'TITLE')
    content = request.POST.get('content', 'CONTENT')

    if id == '0' and title.strip() != '' and content.strip() != '':
        models.Article.objects.create(title=title, content=content)
        articles = models.Article.objects.all()
        return render(request, 'blog/index.html', {'articles': articles})

    try:
        article = models.Article.objects.get(pk=id)
        article.title = title
        article.content = content
        article.save()
        return render(request, 'blog/article_page.html', {'article': article})
    except:
        pass
    return index(request)


def delete_action(request):
    try:
        id = request.GET.get('id')
        article = models.Article.objects.get(pk=id)
        article.delete()
    except:
        pass
    return index(request)
