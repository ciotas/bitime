<div class="card">
  <div class="card-body">
    <a href="#"
       data-toggle="modal" data-target="#createPlan"
       class="btn btn-success btn-block" aria-label="Left Align">
      <i class="fas fa-pencil-alt mr-2"></i>  新建交易计划
    </a>
  </div>
</div>

<div class="modal fade" id="createPlan" tabindex="-1" role="dialog" aria-labelledby="createPlan" aria-hidden="true">
@include('plans.edit', ['plan'=>$plan])
</div>
