/* ==========================================================
 * bootstrap-formhelpers-selectbox.js
 * https://github.com/vlamanna/BootstrapFormHelpers
 * ==========================================================
 * Copyright 2012 Vincent Lamanna
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* SELECTBOX CLASS DEFINITION
  * ========================= */

  var toggle = '[data-toggle=bfh-selectbox]'
    , BFHSelectBox = function (element) {
      }

  BFHSelectBox.prototype = {

    constructor: BFHSelectBox

  , toggle: function (e) {
      var $this = $(this)
        , $parent
        , isActive

      if ($this.is('.disabled, :disabled')) return false

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      clearMenus()

      if (!isActive) {
        $parent.toggleClass('open')
        
        $parent.find('[role=option] > li > [data-option="' + $this.find('.bfh-selectbox-option').data('option') + '"]').focus()
      }

      return false
    }

  , filter: function(e) {
    var $this
      , $parent
      , $items
      
    $this = $(this)
    
    $parent = $this.closest('.bfh-selectbox')
    
    $items = $('[role=option] li a', $parent)
    
    $items.hide()
    
    $items.filter(function() { return ($(this).text().toUpperCase().indexOf($this.val().toUpperCase()) != -1) }).show()
  }
  
  , keydown: function (e) {
      var $this
        , $items
        , $active
        , $parent
        , isActive
        , index

      if (!/(38|40|27)/.test(e.keyCode) && !/[A-z]/.test(String.fromCharCode(e.which))) return

      $this = $(this)

      e.preventDefault()
      e.stopPropagation()

      if ($this.is('.disabled, :disabled')) return false

      $parent = $this.closest('.bfh-selectbox')

      isActive = $parent.hasClass('open')

      if (!isActive || (isActive && e.keyCode == 27)) return $this.click()

      $items = $('[role=option] li a', $parent).filter(':visible')

      if (!$items.length) return

      $('body').off('mouseenter.bfh-selectbox.data-api', '[role=option] > li > a', BFHSelectBox.prototype.mouseenter)
      
      index = $items.index($items.filter(':focus'))

      if (e.keyCode == 38 && index > 0) index--                                        // up
      if (e.keyCode == 40 && index < $items.length - 1) index++                        // down
      if (/[A-z]/.test(String.fromCharCode(e.which))) {
      	var $subItems = $items.filter(function() { return ($(this).text().charAt(0).toUpperCase() == String.fromCharCode(e.which)) })
        var selectedIndex = $subItems.index($subItems.filter(':focus'))
        if (!~selectedIndex) index = $items.index($subItems)
        else if (selectedIndex >= $subItems.length - 1) index = $items.index($subItems)
        else index++
      }
      if (!~index) index = 0
      
      $items
        .eq(index)
        .focus()
        
      $('body').on('mouseenter.bfh-selectbox.data-api', '[role=option] > li > a', BFHSelectBox.prototype.mouseenter)
    }
    
    , mouseenter: function (e) {
	  var $this
	  
	  $this = $(this)
	  
	  if ($this.is('.disabled, :disabled')) return false
	  
	  $this.focus()
    }
    
    , select: function (e) {
      var $this
        , $parent
        , $toggle
        , $input
      
      $this = $(this)
      
      e.preventDefault()
      e.stopPropagation()
      
      if ($this.is('.disabled, :disabled')) return false
      
      $parent = $this.closest('.bfh-selectbox')
      $toggle = $parent.find('.bfh-selectbox-option')
      $input = $parent.find('input[type="hidden"]')
      
      $toggle.data('option', $this.data('option'))
      $toggle.html($this.html())
      
      $input.removeData()
      $input.val($this.data('option'))
      $.each($this.data(), function(i,e) {
        $input.data(i,e);  
      });
      $input.change()
      
      clearMenus()
    }

  }

  function clearMenus() {
    getParent($(toggle))
      .removeClass('open')
  }

  function getParent($this) {
    var selector = $this.attr('data-target')
      , $parent

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && /#/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
    }

    $parent = $(selector)
    $parent.length || ($parent = $this.parent())

    return $parent
  }


  /* SELECTBOX PLUGIN DEFINITION
   * ========================== */

  $.fn.bfhselectbox = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('bfhselectbox')
      this.type = 'bfhselectbox';
      if (!data) $this.data('bfhselectbox', (data = new BFHSelectBox(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  $.fn.bfhselectbox.Constructor = BFHSelectBox

  var origHook
  // There might already be valhooks for the "text" type
  if ($.valHooks.div){
    // Preserve the original valhook function
    origHook = $.valHooks.div
  }
  $.valHooks.div = {
    get: function(el) {
      if($(el).hasClass("bfh-selectbox")){
        return $(el).find('input[type="hidden"]').val()
      }else if (origHook){
        return origHook.get(el)
      }
    },
    set: function(el, val) {
      if($(el).hasClass("bfh-selectbox")){
        var $el = $(el)
          , text = $el.find("li a[data-option='"+val+"']").text()
        $el.find('input[type="hidden"]').val(val)

        $el.find('.bfh-selectbox-option').text(text)
      }else if (origHook){
        return origHook.set(el,val)
      }
    }
  }

  /* APPLY TO STANDARD SELECTBOX ELEMENTS
   * =================================== */

  $(function () {
    $('html')
      .on('click.bfhselectbox.data-api', clearMenus)
    $('body')
      .on('click.bfhselectbox.data-api touchstart.bfhselectbox.data-api'  , toggle, BFHSelectBox.prototype.toggle)
      .on('keydown.bfhselectbox.data-api', toggle + ', [role=option]' , BFHSelectBox.prototype.keydown)
      .on('mouseenter.bfhselectbox.data-api', '[role=option] > li > a', BFHSelectBox.prototype.mouseenter)
      .on('click.bfhselectbox.data-api', '[role=option] > li > a', BFHSelectBox.prototype.select)  
      .on('click.bfhselectbox.data-api', '.bfh-selectbox-filter', function (e) { return false })
      .on('propertychange.bfhselectbox.data-api change.bfhselectbox.data-api input.bfhselectbox.data-api paste.bfhselectbox.data-api', '.bfh-selectbox-filter', BFHSelectBox.prototype.filter)
  })

}(window.jQuery);

 
 var BFHCountriesList = {
   'AF': 'Afghanistan',
   'AL': 'Albania',
   'DZ': 'Algeria',
   'AS': 'American Samoa',
   'AD': 'Andorra',
   'AO': 'Angola',
   'AI': 'Anguilla',
   'AQ': 'Antarctica'  ,
   'AG': 'Antigua and Barbuda' ,
   'AR': 'Argentina' ,
   'AM': 'Armenia' ,
   'AW': 'Aruba' ,
   'AU': 'Australia' ,
   'AT': 'Austria' ,
   'AZ': 'Azerbaijan'  ,
   'BH': 'Bahrain' ,
   'BD': 'Bangladesh',
   'BB': 'Barbados'  ,
   'BY': 'Belarus',
   'BE': 'Belgium',
   'BZ': 'Belize',
   'BJ': 'Benin',
   'BM': 'Bermuda',
   'BT': 'Bhutan',
   'BO': 'Bolivia',
   'BA': 'Bosnia and Herzegovina',
   'BW': 'Botswana',
   'BV': 'Bouvet Island',
   'BR': 'Brazil',
   'IO': 'British Indian Ocean Territory',
   'VG': 'British Virgin Islands',
   'BN': 'Brunei',
   'BG': 'Bulgaria',
   'BF': 'Burkina Faso',
   'BI': 'Burundi',
   'CI': 'Côte d\'Ivoire',
   'KH': 'Cambodia',
   'CM': 'Cameroon',
   'CA': 'Canada',
   'CV': 'Cape Verde',
   'KY': 'Cayman Islands',
   'CF': 'Central African Republic',
   'TD': 'Chad',
   'CL': 'Chile',
   'CN': 'China',
   'CX': 'Christmas Island',
   'CC': 'Cocos (Keeling) Islands',
   'CO': 'Colombia',
   'KM': 'Comoros',
   'CG': 'Congo',
   'CK': 'Cook Islands',
   'CR': 'Costa Rica',
   'HR': 'Croatia',
   'CU': 'Cuba',
   'CY': 'Cyprus',
   'CZ': 'Czech Republic',
   'CD': 'Democratic Republic of the Congo',
   'DK': 'Denmark',
   'DJ': 'Djibouti',
   'DM': 'Dominica',
   'DO': 'Dominican Republic',
   'TP': 'East Timor',
   'EC': 'Ecuador',
   'EG': 'Egypt',
   'SV': 'El Salvador',
   'GQ': 'Equatorial Guinea',
   'ER': 'Eritrea',
   'EE': 'Estonia',
   'ET': 'Ethiopia',
   'FO': 'Faeroe Islands',
   'FK': 'Falkland Islands',
   'FJ': 'Fiji',
   'FI': 'Finland',
   'MK': 'Former Yugoslav Republic of Macedonia',
   'FR': 'France',
   'FX': 'France, Metropolitan',
   'GF': 'French Guiana',
   'PF': 'French Polynesia',
   'TF': 'French Southern Territories',
   'GA': 'Gabon',
   'GE': 'Georgia',
   'DE': 'Germany',
   'GH': 'Ghana',
   'GI': 'Gibraltar',
   'GR': 'Greece',
   'GL': 'Greenland',
   'GD': 'Grenada',
   'GP': 'Guadeloupe',
   'GU': 'Guam',
   'GT': 'Guatemala',
   'GN': 'Guinea',
   'GW': 'Guinea-Bissau',
   'GY': 'Guyana',
   'HT': 'Haiti',
   'HM': 'Heard and Mc Donald Islands',
   'HN': 'Honduras',
   'HK': 'Hong Kong',
   'HU': 'Hungary',
   'IS': 'Iceland',
   'IN': 'India',
   'ID': 'Indonesia',
   'IR': 'Iran',
   'IQ': 'Iraq',
   'IE': 'Ireland',
   'IL': 'Israel',
   'IT': 'Italy',
   'JM': 'Jamaica',
   'JP': 'Japan',
   'JO': 'Jordan',
   'KZ': 'Kazakhstan',
   'KE': 'Kenya',
   'KI': 'Kiribati',
   'KW': 'Kuwait',
   'KG': 'Kyrgyzstan',
   'LA': 'Laos',
   'LV': 'Latvia',
   'LB': 'Lebanon',
   'LS': 'Lesotho',
   'LR': 'Liberia',
   'LY': 'Libya',
   'LI': 'Liechtenstein',
   'LT': 'Lithuania',
   'LU': 'Luxembourg',
   'MO': 'Macau',
   'MG': 'Madagascar',
   'MW': 'Malawi',
   'MY': 'Malaysia',
   'MV': 'Maldives',
   'ML': 'Mali',
   'MT': 'Malta',
   'MH': 'Marshall Islands',
   'MQ': 'Martinique',
   'MR': 'Mauritania',
   'MU': 'Mauritius',
   'MT': 'Mayotte',
   'MX': 'Mexico',
   'FM': 'Micronesia',
   'MD': 'Moldova',
   'MC': 'Monaco',
   'MN': 'Mongolia',
   'ME': 'Montenegro',
   'MS': 'Montserrat',
   'MA': 'Morocco',
   'MZ': 'Mozambique',
   'MM': 'Myanmar',
   'NA': 'Namibia',
   'NR': 'Nauru',
   'NP': 'Nepal',
   'NL': 'Netherlands',
   'AN': 'Netherlands Antilles',
   'NC': 'New Caledonia',
   'NZ': 'New Zealand',
   'NI': 'Nicaragua',
   'NE': 'Niger',
   'NG': 'Nigeria',
   'NU': 'Niue',
   'NF': 'Norfolk Island',
   'KP': 'North Korea',
   'MP': 'Northern Marianas',
   'NO': 'Norway',
   'OM': 'Oman',
   'PK': 'Pakistan',
   'PW': 'Palau',
   'PA': 'Panama',
   'PG': 'Papua New Guinea',
   'PY': 'Paraguay',
   'PE': 'Peru',
   'PH': 'Philippines',
   'PN': 'Pitcairn Islands',
   'PL': 'Poland',
   'PT': 'Portugal',
   'PR': 'Puerto Rico',
   'QA': 'Qatar',
   'RE': 'Reunion',
   'RO': 'Romania',
   'RU': 'Russia',
   'RW': 'Rwanda',
   'ST': 'São Tomé and Príncipe',
   'SH': 'Saint Helena',
   'PM': 'St. Pierre and Miquelon',
   'KN': 'Saint Kitts and Nevis',
   'LC': 'Saint Lucia',
   'VC': 'Saint Vincent and the Grenadines',
   'WS': 'Samoa',
   'SM': 'San Marino',
   'SA': 'Saudi Arabia',
   'SN': 'Senegal',
   'RS': 'Serbia',
   'SC': 'Seychelles',
   'SL': 'Sierra Leone',
   'SG': 'Singapore',
   'SK': 'Slovakia',
   'SI': 'Slovenia',
   'SB': 'Solomon Islands',
   'SO': 'Somalia',
   'ZA': 'South Africa',
   'GS': 'South Georgia and the South Sandwich Islands',
   'KR': 'South Korea',
   'ES': 'Spain',
   'LK': 'Sri Lanka',
   'SD': 'Sudan',
   'SR': 'Suriname',
   'SJ': 'Svalbard and Jan Mayen Islands',
   'SZ': 'Swaziland',
   'SE': 'Sweden',
   'CH': 'Switzerland',
   'SY': 'Syria',
   'TW': 'Taiwan',
   'TJ': 'Tajikistan',
   'TZ': 'Tanzania',
   'TH': 'Thailand',
   'BS': 'The Bahamas',
   'GM': 'The Gambia',
   'TG': 'Togo',
   'TK': 'Tokelau',
   'TO': 'Tonga',
   'TT': 'Trinidad and Tobago',
   'TN': 'Tunisia',
   'TR': 'Turkey',
   'TM': 'Turkmenistan',
   'TC': 'Turks and Caicos Islands',
   'TV': 'Tuvalu',
   'VI': 'US Virgin Islands',
   'UG': 'Uganda',
   'UA': 'Ukraine',
   'AE': 'United Arab Emirates',
   'GB': 'United Kingdom',
   'US': 'United States',
   'UM': 'United States Minor Outlying Islands',
   'UY': 'Uruguay',
   'UZ': 'Uzbekistan',
   'VU': 'Vanuatu',
   'VA': 'Vatican City',
   'VE': 'Venezuela',
   'VN': 'Vietnam',
   'WF': 'Wallis and Futuna Islands',
   'EH': 'Western Sahara',
   'YE': 'Yemen',
   'ZM': 'Zambia',
   'ZW': 'Zimbabwe'
 }
 
 
 /* ==========================================================
 * bootstrap-formhelpers-countries.js
 * https://github.com/vlamanna/BootstrapFormHelpers
 * ==========================================================
 * Copyright 2012 Vincent Lamanna
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */
 
 !function ($) {

  "use strict"; // jshint ;_;


 /* COUNTRIES CLASS DEFINITION
  * ====================== */

  var BFHCountries = function (element, options) {
    this.options = $.extend({}, $.fn.bfhcountries.defaults, options)
    this.$element = $(element)
    
	if (this.options.countrylist) {
		this.countryList = []
		this.options.countrylist = this.options.countrylist.split(',')
        for (var country in BFHCountriesList) {
			if ($.inArray(country, this.options.countrylist) >= 0) {
				this.countryList[country] = BFHCountriesList[country]
			}
		}
	} else {
		this.countryList = BFHCountriesList
	}

    if (this.$element.is("select")) {
      this.addCountries()
    }
    
    if (this.$element.is("span")) {
      this.displayCountry()
    }
    
    if (this.$element.hasClass("bfh-selectbox")) {
      this.addBootstrapCountries()
    }
  }

  BFHCountries.prototype = {

    constructor: BFHCountries

    , addCountries: function () {
      var value = this.options.country
      
      this.$element.html('')
      this.$element.append('<option value=""></option>')
      for (var country in this.countryList) {
        this.$element.append('<option value="' + country + '">' + this.countryList[country] + '</option>')
      }
      
      this.$element.val(value)
    }
    
    , addBootstrapCountries: function() {
      var $input
      , $toggle
      , $options
      
      var value = this.options.country
      
      $input = this.$element.find('input[type="hidden"]')
      $toggle = this.$element.find('.bfh-selectbox-option')
      $options = this.$element.find('[role=option]')
      
      $options.html('')
      $options.append('<li><a tabindex="-1" href="#" data-option=""></a></li>')
      for (var country in this.countryList) {
        if (this.options.flags == true) {
          $options.append('<li><a tabindex="-1" href="#" data-option="' + country + '"><i class="icon-flag-' + country + '"></i>' + this.countryList[country] + '</a></li>')
        } else {
          $options.append('<li><a tabindex="-1" href="#" data-option="' + country + '">' + this.countryList[country] + '</a></li>')
        }
      }
      
      $toggle.data('option', value)
      
      if (value) {
        if (this.options.flags == true) {
          $toggle.html('<i class="icon-flag-' + value + '"></i> ' + this.countryList[value])
        } else {
          $toggle.html(this.countryList[value])
        }
      }
      
      $input.val(value)
    }
    
    , displayCountry: function () {
      var value = this.options.country
      
      if (this.options.flags == true) {
        this.$element.html('<i class="icon-flag-' + value + '"></i> ' + this.countryList[value])
      } else {
        this.$element.html(this.countryList[value])
      }
    }

  }


 /* COUNTRY PLUGIN DEFINITION
  * ======================= */

  $.fn.bfhcountries = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('bfhcountries')
        , options = typeof option == 'object' && option
        
      if (!data) $this.data('bfhcountries', (data = new BFHCountries(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.bfhcountries.Constructor = BFHCountries

  $.fn.bfhcountries.defaults = {
    country: "",
	countryList: "",
    flags: false
  }
  

 /* COUNTRY DATA-API
  * ============== */

  $(window).on('load', function () {
    $('form select.bfh-countries, span.bfh-countries, div.bfh-countries').each(function () {
      var $countries = $(this)

      $countries.bfhcountries($countries.data())
    })
  })


}(window.jQuery);
