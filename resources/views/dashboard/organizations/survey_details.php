<script id="details-template" type="text/x-handlebars-template">


    <div class="col-md-8">
        <div class="portlet light portlet-fit borderless">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-info-circle font-red" aria-hidden="true"></i>
                    <span class="caption-subject font-red sbold uppercase">{{subject}} details</span>
                </div>
            </div>
            <div class="portlet-body">
                <div style="padding:5px"><i>Survey Subject :</i> {{subject}}</div>
                <div style="padding:5px"><i>Description :</i> {{description}}</div>
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

                    {{#if questions}}
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-info-circle font-red" aria-hidden="true"></i>
                            <span class="caption-subject font-red sbold uppercase">{{subject}} Questions</span>
                        </div>
                    </div>
                    <div class="container">
                        <ul class="list-group col-xs-8" style="overflow:hidden">
                            {{#each questions}}
                            <li class="list-group-item col-xs-12 " style="background:#fff;">{{body}}</li>

                                {{#each this.answers}}
                                   <li class="list-group-item col-xs-10 col-xs-offset-1" style="background:#eee;">{{answer}}</li>
                                {{/each}}
                            {{/each}}
                        </ul>
                    </div>
                    {{/if}}

                </div>
            </div>
        </div>
    </div>
</script>