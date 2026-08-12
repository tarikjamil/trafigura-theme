
  <div>
    <div class="embed--typography w-embed">
      <style>
html {
	font-size: calc(100vw/1480);
}
/* body settings */
body {
	overflow-x:hidden;
  overflow: overlay;
  -webkit-font-smoothing: antialiased;
}
@media screen and (min-width: 1480px) {
	html {font-size: 1px;}
}
@media screen and (min-width: 768px) and (max-width: 991px) {
	html {font-size: calc(100vw/768);}
}
@media screen and (min-width: 480px) and (max-width: 767px) {
	html {font-size: calc(100vw/480);}
}
@media screen and (max-width: 479px) {
	html {font-size: calc(100vw/375);}
}
[class*="heading-"] {
	margin-top:0px;
  margin-bottom:0px;
}
[class*="text-"] {
	margin-top:0px;
  margin-bottom:0px;
}
</style>
    </div>
    <div class="embed--items w-embed">
      <style>
[class*="image-wrapper"] {
	width:100%;
  position:relative;
  overflow:hidden;
}
[class*="overlay-"] {
	pointer-events:none;
}
[class*="container-"] {
	margin-left:auto;
  margin-right:auto;
  width:100%
}
.w-richtext > *:first-child { margin-top: 0; }
.w-richtext > *:last-child { margin-bottom: 0; }
</style>
    </div>
  </div><img src="<?php echo udesly_get_image(_u('i317f733b', 'img'))->src ?>" loading="lazy" alt="<?php echo udesly_get_image(_u('i317f733b', 'img'))->alt ?>" data-img="i317f733b" srcset="<?php echo udesly_get_image(_u('i317f733b', 'img'))->srcset ?>">
  <a href="<?php echo _u('a23','link'); ?>" data-text="t3610230d" data-link="a23"><?php echo _u('t3610230d','text'); ?></a>
  <div class="navbar--dropdown is--active">
    <div class="navbar--dropdown-trigger">
      <div class="flexh is--navbar"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 7 6" class="nav--arrow">
          <path id="Polygone_3" data-name="Polygone 3" d="M3.5,0,7,6H0Z" fill="currentColor"></path>
        </svg>
        <div data-text="t645f0031"><?php echo _u('t645f0031','text'); ?></div>
      </div>
    </div>
    <div class="navbar--dropdown--list">
      <?php foreach (udesly_get_menu("about-us") as $menu_item) : ?><a href="<?php echo $menu_item->url; ?>" class="navlink w-inline-block">
        <div><?php echo $menu_item->title; ?></div><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 7 6" class="nav--arrow"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 6 7">
            <path id="Polygone_4" data-name="Polygone 4" d="M3.5,0,7,6H0Z" transform="translate(6) rotate(90)" fill="currentColor"></path>
          </svg></svg>
      </a><?php endforeach ?>
      <div class="navbar--spacer"></div>
    </div>
  </div>
  <div class="w-form">
    <form id="email-form" name="email-form" data-name="Email Form" method="get" data-wf-page-id="65f6c3ae3ad798ab04d846c2" data-wf-element-id="785c96e3-47b5-fcdd-9a4b-9693a8d1f3d7" data-ajax-action="contact"><label for="contact[email]">Email</label><input type="email" name="contact[email]" class="w-input" required="">
      <div class="filter-select"></div>
      <div class="flexh is--gap30">
        <div data-hover="false" data-delay="0" class="drop-select w-dropdown">
          <div class="filter-select w-dropdown-toggle">
            <div>Area of work</div>
            <div class="btn-arrow is--shadow"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 13.87 17.589" class="icon-arrow">
                <path id="Tracé_54617" data-name="Tracé 54617" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(13.87 0) rotate(90)" fill="currentColor"></path>
              </svg></div>
          </div>
          <nav class="w-dropdown-list">
            <a href="<?php echo _u('a23','link'); ?>" class="w-dropdown-link" data-link="a23">Link 1</a>
            <a href="<?php echo _u('a23','link'); ?>" class="w-dropdown-link" data-link="a23">Link 2</a>
            <a href="<?php echo _u('a23','link'); ?>" class="w-dropdown-link" data-link="a23">Link 3</a>
          </nav>
        </div>
        <div data-hover="false" data-delay="0" class="drop-select w-dropdown">
          <div class="filter-select w-dropdown-toggle">
            <div>Region/Country</div>
            <div class="btn-arrow is--shadow"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 13.87 17.589" class="icon-arrow">
                <path id="Tracé_54617" data-name="Tracé 54617" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(13.87 0) rotate(90)" fill="currentColor"></path>
              </svg></div>
          </div>
          <nav class="w-dropdown-list">
            <a href="<?php echo _u('a23','link'); ?>" class="w-dropdown-link" data-link="a23">Link 1</a>
            <a href="<?php echo _u('a23','link'); ?>" class="w-dropdown-link" data-link="a23">Link 2</a>
            <a href="<?php echo _u('a23','link'); ?>" class="w-dropdown-link" data-link="a23">Link 3</a>
          </nav>
        </div>
      </div>
      <div class="filter-radio_wrapper"><label class="radio-btn w-radio">
          <div class="w-form-formradioinput w-form-formradioinput--inputType-custom radio-check w-radio-input"></div><input type="radio" data-name="Radio 4" id="radio-4" name="contact[radio]" style="opacity:0;position:absolute;z-index:-1" value="Radio"><span class="radio-btn-lbel w-form-label" for="radio-4">Ongoing</span>
        </label><label class="radio-btn w-radio">
          <div class="w-form-formradioinput w-form-formradioinput--inputType-custom radio-check w-radio-input"></div><input type="radio" data-name="Radio 4" id="radio-4" name="contact[radio]" style="opacity:0;position:absolute;z-index:-1" value="Radio"><span class="radio-btn-lbel w-form-label" for="radio-4">New</span>
        </label><label class="radio-btn w-radio">
          <div class="w-form-formradioinput w-form-formradioinput--inputType-custom radio-check w-radio-input"></div><input type="radio" data-name="Radio 4" id="radio-4" name="contact[radio]" style="opacity:0;position:absolute;z-index:-1" value="Radio"><span class="radio-btn-lbel w-form-label" for="radio-4">Ended</span>
        </label></div><input type="submit" data-wait="Please wait..." class="hide w-button" value="Submit">
    <?php udesly_honeypot_field() ?></form>
    <div class="w-form-done">
      <div data-text="t5a0ea5a1"><?php echo _u('t5a0ea5a1','text'); ?></div>
    </div>
    <div class="w-form-fail">
      <div data-text="tn7c112e99"><?php echo _u('tn7c112e99','text'); ?></div>
    </div>
  </div>
  <div class="btn--reset" data-text="t4b32d2f"><?php echo _u('t4b32d2f','text'); ?></div>
  <div class="filter-list">
    <div class="filter-radio_wrapper">
      <div class="btn--reset"></div>
    </div>
  </div>
  <div class="social-btn">
    <div data-text="t6854fdf"><?php echo _u('t6854fdf','text'); ?></div>
    <a href="<?php echo _u('a23','link'); ?>" class="social-share w-inline-block" data-link="a23"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 9.56 18.101" class="icon-16">
        <path id="Path_54647" data-name="Path 54647" d="M6.33,28.251v2.1h3.1l-.5,3.23H6.33v7.937a11.509,11.509,0,0,1-1.689.126,10.928,10.928,0,0,1-1.8-.147V33.578H0v-3.23H2.839V27.888a4.415,4.415,0,0,1,1.224-3.3,4.182,4.182,0,0,1,3-1.052,16.342,16.342,0,0,1,2.5.216v2.749H8.153a1.961,1.961,0,0,0-1.24.359,1.693,1.693,0,0,0-.583,1.387" transform="translate(0 -23.54)" fill="currentColor"></path>
      </svg></a>
    <a href="<?php echo _u('a23','link'); ?>" class="social-share w-inline-block" data-link="a23"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.513 17.768" class="icon-16">
        <path id="Tracé_54651" data-name="Tracé 54651" d="M802.293,237.055l-6.3-9.082,6.475-7.515h-1.547l-5.618,6.52-3.71-5.349-.813-1.172h-5.187l.813,1.172,6.024,8.684-6.817,7.912h1.546l5.961-6.919,3.987,5.747.812,1.172h5.187Zm-3.761,0-4.623-6.664-.69-.993-5.388-7.767h2.335l4.346,6.265.69.994,5.665,8.165Z" transform="translate(-785.592 -220.459)" fill="currentColor"></path>
      </svg></a>
    <a href="<?php echo _u('a23','link'); ?>" class="social-share w-inline-block" data-link="a23"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.767 17.768" class="icon-16">
        <g id="Groupe_63" data-name="Groupe 63" transform="translate(-1599.925 -3008.245)">
          <path id="Tracé_54648" data-name="Tracé 54648" d="M2537.278,60.309c0-.3,0-.578,0-.853,0-.9,0-1.741-.051-2.808a6.543,6.543,0,0,0-.414-2.156,4.338,4.338,0,0,0-1.023-1.574,4.261,4.261,0,0,0-1.573-1.024,6.362,6.362,0,0,0-2.156-.412c-.736-.048-2.032-.061-3.663-.054s-2.927.007-3.663.054a6.358,6.358,0,0,0-2.156.412A4.253,4.253,0,0,0,2521,52.917a4.332,4.332,0,0,0-1.023,1.574,6.518,6.518,0,0,0-.414,2.156c-.072,1.393-.043,2.4-.054,3.661v0c0,.3,0,.578,0,.853,0,.9,0,1.741.051,2.808a6.518,6.518,0,0,0,.414,2.156A4.332,4.332,0,0,0,2521,67.7a4.252,4.252,0,0,0,1.573,1.024,6.357,6.357,0,0,0,2.156.412c.736.048,2.032.061,3.663.054s2.927-.007,3.663-.054a6.362,6.362,0,0,0,2.156-.412,4.26,4.26,0,0,0,1.573-1.024,4.338,4.338,0,0,0,1.023-1.574,6.543,6.543,0,0,0,.414-2.156c.072-1.393.043-2.4.054-3.661Zm-1.651,3.58V63.9a5.028,5.028,0,0,1-.3,1.628l-.008.02-.008.02a2.729,2.729,0,0,1-.653,1l-.014.015-.014.015a2.654,2.654,0,0,1-.992.636l-.006,0a4.813,4.813,0,0,1-1.618.3h-.029l-.03,0c-.539.035-1.485.053-2.814.053l-.739,0h-.013l-.739,0c-1.328,0-2.275-.018-2.814-.053l-.03,0h-.03a4.811,4.811,0,0,1-1.618-.3l-.006,0a2.656,2.656,0,0,1-.992-.636l-.014-.015-.015-.015a2.728,2.728,0,0,1-.652-1l-.008-.02-.008-.02a5.015,5.015,0,0,1-.3-1.628v-.014c-.05-.957-.049-1.731-.049-2.551,0-.328,0-.668,0-1.029s0-.7,0-1.029c0-.82,0-1.594.049-2.551v-.013a5.015,5.015,0,0,1,.3-1.628l.008-.02.008-.02a2.729,2.729,0,0,1,.652-1l.015-.014.014-.015a2.656,2.656,0,0,1,.992-.636l.006,0a4.8,4.8,0,0,1,1.617-.3h.03l.03,0c.539-.035,1.486-.053,2.814-.053l.739,0h.013l.739,0c1.329,0,2.275.018,2.814.053l.03,0h.03a4.8,4.8,0,0,1,1.618.3l.006,0a2.654,2.654,0,0,1,.992.636l.014.015.014.014a2.729,2.729,0,0,1,.653,1l.008.02.008.02a5.028,5.028,0,0,1,.3,1.628v.013c.05.957.049,1.731.049,2.551,0,.328,0,.668,0,1.029s0,.7,0,1.029c0,.82,0,1.594-.049,2.551" transform="translate(-919.586 2956.819)" fill="currentColor"></path>
          <path id="Tracé_54649" data-name="Tracé 54649" d="M2631.691,159.036a4.561,4.561,0,1,0,4.561,4.561,4.56,4.56,0,0,0-4.561-4.561m0,7.522a2.961,2.961,0,1,1,2.961-2.961,2.965,2.965,0,0,1-2.961,2.961" transform="translate(-1022.883 2853.532)" fill="currentColor"></path>
          <path id="Tracé_54650" data-name="Tracé 54650" d="M2833.251,128a1.066,1.066,0,1,0,1.066,1.066,1.066,1.066,0,0,0-1.066-1.066" transform="translate(-1219.701 2883.324)" fill="currentColor"></path>
        </g>
      </svg></a>
    <a href="<?php echo _u('a23','link'); ?>" class="social-share w-inline-block" data-link="a23"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 18.14 18.101" class="icon-16">
        <g id="Group_62" data-name="Group 62" transform="translate(-1468.042 -3042.64)">
          <rect id="Rectangle_385" data-name="Rectangle 385" width="3.764" height="12.088" transform="translate(1468.334 3048.653)" fill="currentColor"></rect>
          <path id="Path_54645" data-name="Path 54645" d="M1889.675,127.378V135h-3.764v-5.983a8.07,8.07,0,0,0,0-1.01c-.1-1.476-.71-2.264-2.006-2.264a2.456,2.456,0,0,0-.941.222c-.807.384-1.322,1.294-1.356,3.053V135h-3.764V122.909h3.619l.036,1.534a5,5,0,0,1,4.412-1.964c2.738.448,3.688,2.323,3.764,4.9" transform="translate(-403.492 2925.743)" fill="currentColor"></path>
          <path id="Path_54646" data-name="Path 54646" d="M1743.494,2.175a2.174,2.174,0,1,0-2.174,2.174,2.174,2.174,0,0,0,2.174-2.174" transform="translate(-271.104 3042.639)" fill="currentColor"></path>
        </g>
      </svg></a>
  </div>
  <div class="swiper-arrows">
    <a href="<?php echo _u('a-59a1dacf','link'); ?>" class="swiper-button-prev is--shadow w-inline-block" data-link="a-59a1dacf"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87" class="icon-arrow">
        <path id="Tracé_54632" data-name="Tracé 54632" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(17.588 13.87) rotate(180)" fill="currentColor"></path>
      </svg></a>
    <a href="<?php echo _u('a-59a1dacf','link'); ?>" class="swiper-button-next is--shadow w-inline-block" data-link="a-59a1dacf"><svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 17.589 13.87" class="icon-arrow">
        <path id="Tracé_42314" data-name="Tracé 42314" d="M8.769,0V3.97H0V9.9H8.769v3.97l8.819-6.935Z" transform="translate(0 0)" fill="currentColor"></path>
      </svg></a>
  </div>
  <div class="tale--impact-content">
    <div class="tale--impact-row">
      <h3 class="heading-161" data-text="t4b3b4941"><?php echo _u('t4b3b4941','text'); ?></h3>
      <p data-textarea="tan6340b74b"><?php echo _u('tan6340b74b', 'textarea'); ?></p>
    </div>
  </div>
  <div class="tale--impact-content w-richtext" data-richtext="r61d6f947"><?php echo _u('r61d6f947', 'richtext'); ?></div>
  <div class="richtext--core-pillars w-richtext" data-richtext="r61d6f947"><?php echo _u('r61d6f947', 'richtext'); ?></div>
  <div class="tale--pillar-row"></div>
  
  