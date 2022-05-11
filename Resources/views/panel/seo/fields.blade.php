<div class="tab-pane" id="seo" role="tabpanel"
     aria-labelledby="pills-seo-tab">
    <div class="row">
        <div class="col-6">
            {!! form_row($form->{'seo[title]'}) !!}
        </div>
        <div class="col-6">
            {!! form_row($form->{'seo[robots]'}) !!}
        </div>
        <div class="col-12">
            {!! form_row($form->{'seo[keywords]'}) !!}
        </div>
        <div class="col-12">
            {!! form_row($form->{'seo[description]'}) !!}
        </div>
    </div>
</div>
