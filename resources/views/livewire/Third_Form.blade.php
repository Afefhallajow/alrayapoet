@if($currentStep != 3)
    <div style="display: none" class="row setup-content" id="step-3">
        @endif
        <div class="col-xs-12"  style="width: 1010px;">
            <div class="col-md-12">
                <br>
                <div id="wizard_Details" class="tab-pane" role="tabpanel">
                    <div class="row" style="height: 40vh;">
                        <div class="col-lg-12 mb-3">
                            <div class="form-group" >
                                <label class="text-label">  حدثنا عنك   *</label>
                                <div class="mb-3">
                                    <textarea  name="description" wire:model="description"  class="form-control" cols="30" rows="10" id="comment"></textarea>

                                    </div>
                            </div>
                        </div>


                    </div>
                </div>

            <div class="form-row">
    <button style="border: 0 none;border-radius: 12px;ont-weight: bold;color: white;width: 100px;background: #b79045;cursor: pointer;padding: 10px 5px;margin: 10px 5px;" type="button" wire:click="back(1)">
                    رجوع
                </button>
@if($done==2)
                <button style="border: 0 none;border-radius: 12px;ont-weight: bold;color: white;width: 100px;background: #b79045;cursor: pointer;padding: 10px 5px;margin: 10px 5px;"wire:click="thirdStepSubmit"
                        type="button">التالي</button>
                @endif

            </div>
        </div>

    </div>
    </div>
