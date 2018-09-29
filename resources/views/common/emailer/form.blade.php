<div class="box-body">
    <div class="form-group">
        {{ Form::label('subject', 'Subject :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('subject', null, ['class' => 'form-control', 'id' => 'subject', 'placeholder' => 'Subject', 'data-alnum-type' => 'alphanum', 'data-alnum-length' => 155, 'maxlength' => '155', 'data-alnum-allow' => "'-",'required' => 'required']) }}
            <span id="char-counter" class="text-info"></span>
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('body', 'Body :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::textarea('body', '<p>&nbsp;</p>
<p><strong>CYBERA PRINT ART</strong><br />G/3 &amp; 12, SAMUDRA ANNEXE,&nbsp;NR. HOTEL KLASSIC GOLD, <br />OFF C. G. ROAD, NAVRANGPURA,&nbsp;AHMEDABAD, GUJARAT, INDIA.</p>
<div>Phone : +91 79 2 65 65 720 / 2 64 65 720</div>
<div>Mobile : <a href="tel:0%2098%2098%2030%2098%2097" target="_blank">0 98 98 30 98 97</a><br />WEBSITE : <a href="http://www.cybera.in/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en-GB&amp;q=http://www.cybera.in&amp;source=gmail&amp;ust=1477681956691000&amp;usg=AFQjCNEAajUeeC_HxQtAH5-HOpleFdOxlA">www.cybera.in</a>
<div>&nbsp;</div>
<div><strong><span style="color: #ff0000;">OUR WORKING HOURS</span></strong></div>
<div>MONDAY TO SATURDAY &nbsp;10:00 AM TO 8:00 PM</div>
<div>SUNDAY CLOSED</div>
<div><br /><span style="color: #ff6600;"><strong>FOR SUGGESTIONS &amp; COMPLAINTS</strong></span><br />Mobile : <a href="tel:0%2098%2098%2061%2086%2097" target="_blank">0 98 98 61 86 97</a><br />E-mail : <a href="mailto:shaishav77@gmail.com" target="_blank">shaishav77@gmail.com</a></div>
</div>', ['class' => 'form-control', 'id' =>'body',   'cols' => 40, 'rows' => 4]) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('send-sms', 'Send Sms :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <input type="checkbox" name="send-sms" id="switch-change" value="0" data-toggle="toggle">
        </div>
    </div>

    <div class="form-group" id="smsContainer" style="display: none;">
        {{ Form::label('sms', 'Sms :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">

            {{ Form::text('sms', null, ['class' => 'form-control', 'id' => 'sms', 'placeholder' => 'SMS', 'data-alnum-type' => 'alphanum', 'data-alnum-length' => 150, 'maxlength' => '150', 'data-alnum-allow' => "'-"]) }}
            <span id="sms-char-counter" class="text-info"></span>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ URL::asset('js/tinymce.min.js') }}"></script>


<script type="text/javascript">
//Tiny Mce Editor
tinymce.init({
    selector: 'textarea',
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
    automatic_uploads: true,
    height: 300,
    theme: 'modern',
    plugins: [
        'image',
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
    ],
    toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons',
    image_advtab: true,
    templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
    ],
    content_css: [
        'https://www.tiny.cloud/css/codepen.min.css'
    ],
    file_browser_callback: function(field_name, url, type, win) {
        if(type=='image')
        {
            $('#my_form input').click();    
        } 
    }
     });


</script>
