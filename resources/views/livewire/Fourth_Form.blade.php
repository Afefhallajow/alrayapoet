<div>
@if($currentStep == 4)
<div  class="row setup-content" id="step-3">
    <div class="col-xs-12"  >
<div class="col-md-12">
<br>
    <div class="form-row">

<div class="first" style="height:auto;direction:rtl;text-align:right;padding:0px">

<h5 style="text-align:center;">
</h5>
<h4>
</h4>
<h4  >
الشروط الخاصة بآلية ومحتوى المشاركة في مسابقة برنامج شاعر الراية:
</h4>
<ul style="padding:1rem">
<li>
</li>
<li>
    -	عمر المتقدم لا يقل عن 18 عام ولا يزيد عن 45 عام.</li>
<li>
    -	 أن يحمل المتسابق جنسية إحدى الدول العربية.</li>
<li>
    -	أن يمتلك المتسابق موهبة تأليف الشعر وإلقائه. </li>
<li>
    -	المشاركة (القصيدة) لم يسبق لها الظهور الإعلامي في أي وسيلة إعلامية أو منصات التواصل الاجتماعي أو في أي مسابقة أخرى.</li>
<li>
    -	يتم رفع المشاركة (القصيدة) عبر (البوابة) بالصيغ التالية:
</li><li>    _ مقطع مصور للمشاركة مدته لا تقل عن 60 ثانية ولا تزيد عن 120 ثانية يلقي فيه قصيده المشاركة (قصيدة نبطية موزونة ومقفاه لا تقل عن 12 بيت ولا تزيد عن 15 بيت).

</li>
<li>
    <ul style="list-style-type: ' - ';">
<li>
<li style="font-weight: bold">                                            نص مكتوب (خالي من الأخطاء المطبعية) يتم إرفاقها كصورة واضحة او pdf.
</li>
</li>
    <li>
        -	تسجيل المشاركة مرة واحد فقط (الرجاء التأكد من إرفاق القصيدة نصاً وفيديو بشكل واضح).    </li>
    <li>
        -	أن يوافق المتسابق على التواجد داخل مواقع التصوير لمدة ثلاثة أشهر متواصلة وعدم وجود ما يمنع المتسابق من استمرار تواجده اثناء فترة التصوير.</li>

    <li>
        -	أن يلتزم المتسابق بالمبادئ الاخلاقية ويحترم المعايير المهنية الإعلامية باعتباره ممثلا لبلاده ونموذج مشرفا لها. </li>
    <li>
        -	أن يلتزم المتسابق بالمبادئ الاخلاقية ويحترم المعايير المهنية الإعلامية باعتباره ممثلا لبلاده ونموذج مشرفا لها.    </li>

    <li>
        -	أن يلتزم المتسابق بكافة تعليمات فريق الإدارة والأعداد التي تساعده على تطوير موهبته طوال فترة بث البرنامج.</li>
<br><br>
        <li>
            قبول نشر وعرض أية نصوص، أو صور، أو فيديوهات، أو تسجيلات صوتية في الحلقات أو في حسابات التواصل الاجتماعي التابع لبرنامج شاعر الراية.
        </li>

    </ul>

</li>
</ul>

<div class="form-group" style="margin-right:2.5rem">
<div class="form-check d-flex">
    @if($check)
    <input wire:model="check" class="form-check-input col-2" type="checkbox" id="FieldsetCheck" >
    @endif
        <label style="font-family: 'Tajawal', sans-serif;" class="form-check-label" id="myLabelcheck" for="FieldsetCheck">
<a  wire:click="backtobase1" style="cursor: pointer ;color:#b79045">
أوافق على الشروط والاحكام الخاصة بوابة تسجيل المشاركات لمسابقة (برنامج شاعر الراية )
</a>


</label>

</div>


</div>


    @if($check)
<div style="text-align:center">
<input style="border: 0 none;border-radius: 12px;ont-weight: bold;color: white;width: 100px;background: #b79045;cursor: pointer;padding: 10px 5px;margin: 10px 5px;"  wire:click="submitForm" type="button"  o name="next" class="next action-button lastAccept" id="lastAccept" value="التالي" />
<p class="pacceptmsg" style="color:red;visibility:hidden">
يجب الموافقة على الشروط والأحكام</p>
</div>
</div>
@endif

</div>




</div>
</div>

</div>
@endif
</div>
