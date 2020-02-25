@can('manage_trades')
  <button
     data-toggle="modal" data-target="#createPlan"
     class="btn btn-outline-success btn-sm my-2 my-sm-0" aria-label="Left Align">
    <i class="fas fa-pencil-alt mr-2"></i>  发布交易计划
  </button>
  <div class="modal fade" id="createPlan" tabindex="-1" role="dialog" aria-labelledby="createPlan" aria-hidden="true">
    @include('plans.edit', ['plan'=>$plan])
  </div>
@else
  @guest
    <a href="{{ route('login') }}" style="color: white"
      class="btn btn-success btn-sm">
      <i class="fas fa-pencil-alt mr-2"></i>  我要诊股
    </a>
  @else
    <button
            data-toggle="modal" data-target="#diagnosis"
            class="btn btn-success btn-sm" aria-label="Left Align">
      <i class="fas fa-pencil-alt mr-2"></i>  我要诊股
    </button>
    <div class="modal fade" id="diagnosis" tabindex="-2" role="dialog" aria-labelledby="diagnosis" aria-hidden="true">
      @include('plans.diagnosis')
    </div>
  @endguest
@endcan


