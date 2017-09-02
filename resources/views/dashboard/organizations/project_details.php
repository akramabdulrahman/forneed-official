<script id="details-template" type="text/x-handlebars-template">


    <div class="col-md-8">
        <div class="portlet light portlet-fit borderless">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-info-circle font-red" aria-hidden="true"></i>
                    <span class="caption-subject font-red sbold uppercase">{{name}} details</span>
                </div>
            </div>
            <div class="portlet-body">
                <div style="padding:5px"><i>Project Name :</i> {{name}}</div>
                <div style="padding:5px"><i>Project Sectors :</i> {{sector.name}}</div>
                <div style="padding:5px"><i>Project affiliate :</i> {{service_provider.name}}</div>
                <div style="padding:5px"><i>Project Donor :</i> {{sponsor}}</div>
                <div style="padding:5px"><i>Project Period :</i> From {{starts_at}}
                    To {{expires_at}}
                </div>
                <div style="padding:5px">
                    <i>Project Beneficiaries :</i>
                    <div class="container">
                        <ul class="list-group col-xs-8">
                            {{#each extras}}
                            <li class="list-group-item col-xs-6 even" style="background:#fff;">{{name}}</li>
                            <li class="list-group-item col-xs-6 " style="background:#eee;">{{extra}}</li>
                            {{/each}}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</script>