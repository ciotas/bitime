<a href="#" data-toggle="modal" data-target="#createPlan{{$plan->id}}" class="card-link">编辑</a>

<div class="modal fade" id="createPlan{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="createPlan" aria-hidden="true">
  @include('plans.edit', ['plan'=>$plan])
</div>
