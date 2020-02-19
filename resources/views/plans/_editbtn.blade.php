<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#createPlan{{$plan->id}}" >
   重新计算
</button>
<div class="modal fade" id="createPlan{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="createPlan" aria-hidden="true">
  @include('plans.edit', ['plan'=>$plan])
</div>
