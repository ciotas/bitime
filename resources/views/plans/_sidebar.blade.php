@can('manage_trades')
  <button href="#"
     data-toggle="modal" data-target="#createPlan"
     class="btn btn-outline-success btn-sm my-2 my-sm-0" aria-label="Left Align">
    <i class="fas fa-pencil-alt mr-2"></i>  发布交易计划
  </button>
  <div class="modal fade" id="createPlan" tabindex="-1" role="dialog" aria-labelledby="createPlan" aria-hidden="true">
    @include('plans.edit', ['plan'=>$plan])
  </div>
@else
  <button href="#"
     data-toggle="modal" data-target="#diagnosis"
     class="btn btn-success btn-sm" aria-label="Left Align">
    <i class="fas fa-pencil-alt mr-2"></i>  我要诊股
  </button>
  <div class="modal fade" id="diagnosis" tabindex="-1" role="dialog" aria-labelledby="diagnosis" aria-hidden="true">
    @include('plans.diagnosis')
  </div>
@endcan


