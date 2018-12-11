#from django.shortcuts import render
#from django.http import *
from django.shortcuts import *
from django.db.models import F
from django.views import generic

from .models import *


# Create your views here.


class IndexView(generic.ListView):
    template_name = 'pollsapp/index.html'
    context_object_name = 'latest_question_list'
    paginate_by = 4 # if pagination is desired

    def get_queryset(self):
        """Return the last five published questions."""
        # return Question.objects.filter(
        #         pub_date__lte=timezone.now()
        # ).order_by('-pub_date')[:5]
        return Question.objects.filter(
                pub_date__lte=timezone.now()
        ).order_by('-pub_date')

    def get_context_data(self, *, object_list=None, **kwargs):
        # Call the base implementation first to get a context
        context = super().get_context_data(**kwargs)
        # Add in a QuerySet of all the books
        # context['book_list'] = Book.objects.all()
        context['s'] = '<a href="#">123</a>'
        return context


class DetailView(generic.DetailView):
    # model = Question
    template_name = 'pollsapp/detail.html'
    def get_queryset(self):
        """
        Excludes any questions that aren't published yet.
        """
        return Question.objects.filter(pub_date__lte=timezone.now())


class ResultsView(generic.DetailView):
    model = Question
    template_name = 'pollsapp/results.html'


def vote(request, question_id):
    question = get_object_or_404(Question, pk=question_id)
    try:
        selected_choice = question.choice_set.get(pk=request.POST['choice'])
    except (KeyError, Choice.DoesNotExist):
        # Redisplay the question voting form.
        return render(request, 'pollsapp/detail.html', {
            'question': question,
            'error_message': "You didn't select a choice.",
        })
    else:
        # selected_choice.votes += 1
        selected_choice.votes = F('votes') + 1
        selected_choice.save()
        # Always return an HttpResponseRedirect after successfully dealing
        # with POST data. This prevents data from being posted twice if a
        # user hits the Back button.
        return HttpResponseRedirect(reverse('pollsapp:results', args=(question.id,)))











