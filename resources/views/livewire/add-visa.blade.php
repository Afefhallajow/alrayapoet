<div>

    @if($currentStep ==1 ||$currentStep==2 ||$currentStep==3)

        <div style="height: 20px" class="stepwizard">
            <div  class="stepwizard-row setup-panel row">
                <div class="stepwizard-step col-4">
                    <a href="#step-1" type="button"
                       class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                    <p>معلومات شخصية</p>
                </div>
                <div class="stepwizard-step col-4">
                    <a href="#step-2" type="button"
                       class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                    <p>التحميل</p>
                </div>
                <div class="stepwizard-step col-4">
                    <a href="#step-3" type="button"
                       class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                       disabled="disabled">3</a>
                    <p>حدثنا عنك</p>
                </div>
            </div>
        </div>
    @endif
    @include('livewire.First_Form')
        @include('livewire.Second_Form')
        @include('livewire.Third_Form')
        @include('livewire.Fourth_Form')
        @include('livewire.Fifth_Form')

        @include('livewire.final_Form')


        </div>
