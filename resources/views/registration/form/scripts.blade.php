@section('extrascripts')
<script src="/js/bootstrap-select.js"></script>
<script>
  function addfileinput(questionshortname)
  {
    var htmlstr = document.getElementById(questionshortname + ':extra').innerHTML;
    var i = document.getElementById(questionshortname + ':extra').childElementCount;
    // Expect one child already (the hidden input), so add 1 to begin the new children.
    i = i + 1;

    htmlstr = htmlstr + '                            <div class="col-md-12">';
    htmlstr = htmlstr + '                              <div class="input-group">';
    htmlstr = htmlstr + '                                <div class="input-group-prepend">';
    htmlstr = htmlstr + '                                  <div class="input-group-text rounded-0">';
    htmlstr = htmlstr + '                                    <div class="pretty p-icon p-toggle p-plain pr-0 mr-0">';
    htmlstr = htmlstr + '                                      <input type="checkbox"';
    htmlstr = htmlstr + '                                             name="' + questionshortname + '[checkbox][' + i + ']"';
    htmlstr = htmlstr + '                                       aria-label="Checkbox for following text input"';
    htmlstr = htmlstr + '                                              checked>';
    htmlstr = htmlstr + '                                      <div class="state p-on">';
    htmlstr = htmlstr + '                                        <i class="icon material-icons text-primary">check_box</i>';
    htmlstr = htmlstr + '                                        <label></label>';
    htmlstr = htmlstr + '                                      </div>';
    htmlstr = htmlstr + '                                      <div class="state p-off">';
    htmlstr = htmlstr + '                                        <i class="icon material-icons text-secondary">check_box_outline_blank</i>';
    htmlstr = htmlstr + '                                        <label></label>';
    htmlstr = htmlstr + '                                      </div>';
    htmlstr = htmlstr + '                                    </div>';
    htmlstr = htmlstr + '                                  </div>';
    htmlstr = htmlstr + '                                </div>';
    htmlstr = htmlstr + '                                <input class="rounded-0 form-control" type="file" name="' + questionshortname + '[file][' + i + ']" id="' + questionshortname + ':file:' + i + '" aria-label="File input with checkbox">';
    htmlstr = htmlstr + '                              </div>';
    htmlstr = htmlstr + '                            </div>';

    document.getElementById(questionshortname + ':extra').innerHTML = htmlstr;
  }
  function customselect(questionshortname)
  {
    var htmlstr = document.getElementById(questionshortname + ':custom').innerHTML;
    var selectvalinternal = document.getElementById(questionshortname).value;
    var selectvaldisplay = document.getElementById(questionshortname + ':' + selectvalinternal).innerHTML;
    var i = document.getElementById(questionshortname + ':custom').childElementCount;
    htmlstr = htmlstr + '<div class="form-row">';
    htmlstr = htmlstr +   '<div class="col-md-6">';
    htmlstr = htmlstr +     '<div class="form-control-plaintext">';




      htmlstr = htmlstr +     '<div class="pl-0 form-check">';
      htmlstr = htmlstr +       '<div class="pretty p-icon p-toggle p-plain">';
      htmlstr = htmlstr +         '<input class="form-check-input" ';
      htmlstr = htmlstr +                 'type="checkbox" ';
      htmlstr = htmlstr +                   'id="' + questionshortname + ':checkbox:' + i + '" ';
      htmlstr = htmlstr +                'value="' + selectvalinternal + '" ';
      htmlstr = htmlstr +                 'name="' + questionshortname + '[checkbox][' + i + ']" ';
      htmlstr = htmlstr +         ' checked >';

    htmlstr = htmlstr +           '<div class="state p-on">';
    htmlstr = htmlstr +             '<i class="icon material-icons text-primary">check_box</i>';
      htmlstr = htmlstr +           '<label class="form-check-label" for="' + questionshortname + ':checkbox:' + i + '">' + selectvaldisplay + '</label>';
    htmlstr = htmlstr +           '</div>';
    htmlstr = htmlstr +           '<div class="state p-off">';
    htmlstr = htmlstr +             '<i class="icon material-icons text-secondary">check_box_outline_blank</i>';
      htmlstr = htmlstr +           '<label class="form-check-label" for="' + questionshortname + ':checkbox:' + i + '">' + selectvaldisplay + '</label>';
    htmlstr = htmlstr +           '</div>';
    htmlstr = htmlstr +         '</div>';
      
      htmlstr = htmlstr +     '</div>';




    htmlstr = htmlstr +     '</div>';
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr +   '<div class="col-md-6">';
    htmlstr = htmlstr +     '<input class="rounded-0 form-control" name="' + questionshortname + '[customtext][' + i + ']">';
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr + '</div>';
    document.getElementById(questionshortname + ':custom').innerHTML = htmlstr;
  }
  function deselect(questionshortname)
  {
    var radiolist = document.getElementsByName(questionshortname);
    for(var i = 0 ; i < radiolist.length; i++)
    {
      radiolist[i].checked = false;
    }
    document.getElementById(questionshortname + ":deselected").checked = true;
  }
  function addsubquestionradio(questionshortname,html5required,radios)
  {
    var htmlstr = document.getElementById(questionshortname + ':othertext:container').innerHTML;
    var i1 = document.getElementById(questionshortname + ':container').childElementCount;
    var i2 = document.getElementById(questionshortname + ':othertext:container').childElementCount;
    var i = i1 + i2;

    htmlstr = htmlstr + '<div class="form-row form-row-striped">';
    htmlstr = htmlstr +   '<div class="col-4">';
    htmlstr = htmlstr +     '<input type="text" class="form-control rounded-0" placeholder="Other" name=' + questionshortname + ':othertext[' + i + ']">';
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr +   '<div class="col-8">';
    var isdefault;
    for(var j = 0; j < radios.length; j++)
    {
      var radio = radios[j];
      if(radio.charAt(0) === '!')
      {
        isdefault = true;
        radio = radio.substring(1);
      }
      else
      {
        isdefault = false;
      }
      radio = radio.split('^');
      radio[1] = radio[1] || radio[0];
      htmlstr = htmlstr +     '<div class="pl-0 form-check">';
      htmlstr = htmlstr +       '<div class="pretty p-icon p-toggle p-plain">';
      htmlstr = htmlstr +         '<input class="form-check-input" ';
      htmlstr = htmlstr +                 'type="radio" ';
      htmlstr = htmlstr +                   'id="' + questionshortname + '[othertext][' + i + ']" ';
      htmlstr = htmlstr +                'value="' + radio[1] + '" ';
      htmlstr = htmlstr +                 'name="' + questionshortname + '[othertext][' + i + ']" ';
      htmlstr = htmlstr +                       (html5required ? 'required ' : '');
      htmlstr = htmlstr +         '>';

    htmlstr = htmlstr +           '<div class="state p-on">';
    htmlstr = htmlstr +             '<i class="icon material-icons text-primary">radio_button_checked</i>';
      htmlstr = htmlstr +           '<label class="form-check-label" for="' + questionshortname + '[othertext][' + i + ']">' + radio[0] + '</label>';
    htmlstr = htmlstr +           '</div>';
    htmlstr = htmlstr +           '<div class="state p-off">';
    htmlstr = htmlstr +             '<i class="icon material-icons text-secondary">radio_button_unchecked</i>';
      htmlstr = htmlstr +           '<label class="form-check-label" for="' + questionshortname + '[othertext][' + i + ']">' + radio[0] + '</label>';
    htmlstr = htmlstr +           '</div>';
    htmlstr = htmlstr +         '</div>';
      
      htmlstr = htmlstr +     '</div>';
    }
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr + '</div>';

    document.getElementById(questionshortname + ':othertext:container').innerHTML = htmlstr;
  }
  function addothertext(questionshortname,istring,elaborations = null)
  {
    var i = document.getElementById(questionshortname + ':' + istring + ':container').childElementCount;
    var htmlstr = document.getElementById(questionshortname + ':' + istring + ':container').innerHTML;
    htmlstr = htmlstr + '<div class="input-group">';
    htmlstr = htmlstr +   '<div class="input-group-prepend">';
    htmlstr = htmlstr +     '<div class="input-group-text rounded-0">';
    htmlstr = htmlstr +       '<div class="pretty p-icon p-toggle p-plain pr-0 mr-0">';
    htmlstr = htmlstr +         '<input type="checkbox" name="' + questionshortname + '[' + istring + '][' + i + ']" value="' + i + '" aria-label="Checkbox button for following text input" checked>';
    htmlstr = htmlstr +         '<div class="state p-on">';
    htmlstr = htmlstr +           '<i class="icon material-icons text-primary">check_box</i>';
    htmlstr = htmlstr +           '<label></label>';
    htmlstr = htmlstr +         '</div>';
    htmlstr = htmlstr +         '<div class="state p-off">';
    htmlstr = htmlstr +           '<i class="icon material-icons text-secondary">check_box_outline_blank</i>';
    htmlstr = htmlstr +           '<label></label>';
    htmlstr = htmlstr +         '</div>';
    htmlstr = htmlstr +       '</div>';
    htmlstr = htmlstr +     '</div>';
    htmlstr = htmlstr +   '</div>';
    htmlstr = htmlstr +   '<input type="text" class="form-control rounded-0" name="' + questionshortname + ':' + istring + '[' + i + ']" aria-label="Text input with radio button" placeholder="Other">';
    htmlstr = htmlstr + '</div>';
    document.getElementById(questionshortname + ':' + istring + ':container').innerHTML = htmlstr;
  }
</script>
@endsection
