<!--script src="//cdnjs.cloudflare.com/ajax/libs/parsley.js/2.0.5/parsley.min.js"></script-->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/black-tie/jquery-ui.css">
<script src="{{ pluginDirUrl }}chosen/chosen.jquery.min.js"></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script>
w3.includeHTML();
</script>
<script type="text/javascript">
 function expandCollapse(showHide) {
    	
		var hideShowDiv = document.getElementById(showHide);
		var label = document.getElementById("expand");

		if (hideShowDiv.style.display == 'none') {
			label.innerHTML = label.innerHTML.replace("+", "-");
			hideShowDiv.style.display = 'block';			
		} else {
			label.innerHTML = label.innerHTML.replace("-", "+");
			hideShowDiv.style.display = 'none';

		}
	}
 </script>
<link rel="stylesheet" href="{{ pluginDirUrl }}chosen/chosen.min.css">
    <div class="block-heading"><h4><span class="heading-icon"><i class="fa fa-caret-right icon-design"></i><i class="fa fa-copy"></i></span>{{template.number}} {{ template.title }}</h4></div>
<form action="{{ createLink }}" method="post" id="myForm" class="smart-green" style="padding-bottom:45px;">
    <input type="hidden" name="template_id" value="{{ template.id }}">
    <div style="padding:15px 15px 25px 15px; margin-bottom:15px; border: 1px solid #cccccc; border-radius: 3px;">
	<table width="100%" style="text-align: center;">
	<tr>
	<td width="50%" style="border-right: 1px solid #cccccc;">
        <label for="office_id">Select Office</label>
        <select name="office_id" id="office_id" style="width:200px;" required>
            <option value="">-- Choose Office --</option>
        {{#offices}}
            <option value="{{ id }}">{{ name }}</option>
        {{/offices}}
        </select>
	</td>
	<td width="50%">
        <label for="form_title">File Name</label>{{ formTitle }}-
    <input type="text2" name="form_title" value="" class="text" style="width:200px; border: 1px solid #cccccc; border-radius: 3px; height:34px; line-height:24px; padding: 6px 12px;">
	</td>
	</tr>
	</table>
	</div>
    {{#showOptions}}
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:inherit; text-align:center; background-color: #FFF; padding:20px 10px 10px 10px;">
      <th colspan="6" class="infophone effect6" style="text-align:center">Property & Tenant Info</th>
      <tr>
      <td width="17%" style="padding-top:30px;">
    <a onclick="expandCollapse('showHide');" id="expand" class="btn btn-default btn-sm"> + Manual Entry </a>
    </td>
  <td width="40%">
    <div class="form-group" style="margin: 0px 0px 0px 0px;">
        <label for="property_name">Property Name</label>
        <select name="property_name" id="property_name" class="full-width">
            <option value="">Select</option>
            {{#properties}}
                <option value="{{ property_name }}" {{ selected }}>{{ property_name }}</option>
            {{/properties}}
        </select>
    </div>
    </td>
    <td width="10%">
    <div class="form-group" style="margin: 0px 0px 0px 0px;">
        <label for="unit_number">Unit #</label>
        <select name="unit_number" id="unit_number" class="full-width">
            <option value="{{ property.unit_number }}">{{ property.unit_number }}</option>
        </select>
    </div>
    </td>
    <td width="25%">
    <div class="form-group" style="margin: 0px 0px 0px 0px;">
        <label for="tenant_names">Tenant Name</label>
        <select name="tenant_names" id="tenant_names" class="full-width">
            <option value="{{ property.firstname }} {{ property.lastname }}">{{ property.firstname }} {{ property.lastname }}</option>
        </select>
    </div>
    </td>
        <td width="8%">
        <label for="">et. al</label>
        <input name="etal" type="checkbox" value=", et. al (and all others)" />
    </td>
    </tr>
    </table>
    {{/showOptions}}
    
    {{{ template.form_html }}}
    <p class="submit">
        <button type="submit" class="btn btn-primary" style="float:right" id="SubmitForm">Generate</button>
    </p>
</form>

<script>
Object.size = function(obj) {
	var size = 0, key;
	for (key in obj) {
		if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};    
</script>

<script>
jQuery(document).ready(function(){
        //jQuery("form").parsley();
        jQuery(".datepicker").datepicker();
        jQuery("#property_name, #unit_number, #tenant_names").chosen({
            width: "99%"
        });
        jQuery("#property_name").on("change", function(e, params){
            var propertyId = params.selected;
            var name = jQuery(this).find("option:selected").text();
            var url = "?api=1&action=getPropertyUnits&property_id=" + propertyId + "&property_name=" + encodeURIComponent(name);
            jQuery("#tenant_names").html("");
            jQuery("#tenant_names").trigger("chosen:updated");
            
            jQuery.getJSON(url, function(units){
                var options = [];
                var total = Object.size(units);
                if(total > 1){
                    var option = document.createElement("option");
                    option.value = "";
                    option.innerHTML = "Choose Unit";
                    options.push(option);
                    units = jQuery.map(units, function(el) { return el; });
                    units.sort();
                }
                jQuery.each(units, function(key, value){
                    var option = document.createElement("option");
                    option.value = value;
                    option.innerHTML = value;
                    options.push(option);
                });
                jQuery("#unit_number").html(options);
                jQuery("#unit_number").trigger("change");
                jQuery("#unit_number").trigger("chosen:updated");
            });
        });

        jQuery("#unit_number").on("change", function(e, params){
            var propertyId = jQuery(this).find("option:selected").val();
            var unitNumber = jQuery(this).find("option:selected").text();
            var name = jQuery("#property_name").find("option:selected").text();
            var url = "?api=1&action=getPropertyUnitTenants&property_id=" + propertyId + "&property_name=" + name + "&unit_number=" + encodeURIComponent(unitNumber);
            jQuery.getJSON(url, function(tenants){
                var options = [];
                var total = Object.size(tenants);
                if(total > 1){
                    var option = document.createElement("option");
                    option.value = "";
                    option.innerHTML = "Choose Tenants";
                    options.push(option);
                }
                jQuery.each(tenants, function(key, value){
                    var option = document.createElement("option");
                    option.value = value.firstname + "|" + value.lastname;
                    option.innerHTML = value.firstname + " " + value.lastname;
					/*<?php if(isset($_GET['f_tenant_names'])){ ?>								
						if(option.innerHTML=="<?php echo $_GET['f_tenant_names']; ?>")
							option.selected = true;								
					<?php } ?>	*/
                    options.push(option);
                });
                jQuery("#tenant_names").html(options);
                jQuery("#tenant_names").trigger("change");
                jQuery("#tenant_names").trigger("chosen:updated");
            });
        });

		jQuery('#SubmitForm').on('click', function(event) { // Fixes 406 unsupported error
			jQuery('[name="slim[]"]').val(''); //return false;
		});
    });
</script>
