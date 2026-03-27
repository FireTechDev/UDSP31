( function () {
  const root = document.querySelector( "[data-static-content-root]" );
  const pageKey = document.body.dataset.staticPage;
  const pagesSrc = document.body.dataset.pagesSrc;
  const assetPrefix = document.body.dataset.assetPrefix || "assets/images";

  if ( !root || !pageKey || !pagesSrc ) {
    return;
  }

  const icons = {
    phone: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M21 16.2v3a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 10.2 18a19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 1 3.2 2 2 0 0 1 3 1h3a2 2 0 0 1 2 1.7l.5 3a2 2 0 0 1-.6 1.8L6.6 8.9a16 16 0 0 0 8.5 8.5l1.4-1.3a2 2 0 0 1 1.8-.6l3 .5A2 2 0 0 1 21 16.2Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    mail: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 5h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m3 7 9 6 9-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    arrow: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 12h14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="m13 6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    heart: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m12 20-1.4-1.3C5.4 14 2 10.9 2 7.1A4.8 4.8 0 0 1 6.8 2 5.2 5.2 0 0 1 12 5.1 5.2 5.2 0 0 1 17.2 2 4.8 4.8 0 0 1 22 7.1c0 3.8-3.4 6.9-8.6 11.6Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>',
    shield: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5c0 4.4 2.8 8.5 7 10 4.2-1.5 7-5.6 7-10V6l-7-3Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m12 8 1.2 2.3 2.5.4-1.8 1.8.4 2.5-2.3-1.2-2.3 1.2.4-2.5-1.8-1.8 2.5-.4L12 8Z" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>',
    graduation: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m2 9.5 10-5 10 5-10 5-10-5Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M6 11.5V16c0 1.7 3 3 6 3s6-1.3 6-3v-4.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M22 9.5v5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
    users: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M16 21v-1.5A3.5 3.5 0 0 0 12.5 16H7.5A3.5 3.5 0 0 0 4 19.5V21" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="10" cy="8" r="3" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M20 21v-1.5A3.5 3.5 0 0 0 17.4 16.1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M15.4 5.1a3 3 0 0 1 0 5.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
    document: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M14 3v6h6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 13h6M9 17h6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
    calendar: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M16 3v4M8 3v4M3 10h18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
    clock: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 7v5l3 2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    location: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 21s7-4.8 7-11a7 7 0 1 0-14 0c0 6.2 7 11 7 11Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.5" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>',
    handshake: '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M8 8 4.5 11.5a2 2 0 0 0 0 2.8l2.2 2.2a2 2 0 0 0 2.8 0l2.1-2.1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="m16 8 3.5 3.5a2 2 0 0 1 0 2.8l-2.2 2.2a2 2 0 0 1-2.8 0L12 14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="m9 11 2.2-2.2a2 2 0 0 1 2.8 0L16 11" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>'
  };

  function escapeHtml( value ) {
    return String( value )
      .replace( /&/g, "&amp;" )
      .replace( /</g, "&lt;" )
      .replace( />/g, "&gt;" )
      .replace( /"/g, "&quot;" )
      .replace( /'/g, "&#039;" );
  }

  function imageSrc( fileName ) {
    return assetPrefix.replace( /\/$/, "" ) + "/" + encodeURIComponent( fileName );
  }

  function resolveTarget( target ) {
    if ( !target ) {
      return "index.html";
    }

    if ( target.startsWith( "anchor:" ) ) {
      return "#" + target.slice( 7 ).replace( /^#/, "" );
    }

    if ( target.startsWith( "page:" ) ) {
      return target.slice( 5 ) + ".html";
    }

    if ( target === "home" ) {
      return "index.html";
    }

    if ( target === "discover" ) {
      return "decouvrir-ludsp31.html";
    }

    if ( target === "executive" ) {
      return "le-bureau-executif.html";
    }

    return target;
  }

  function iconMarkup( name, className ) {
    if ( !name || !icons[ name ] ) {
      return "";
    }

    return `<span class="${ className }">${ icons[ name ] }</span>`;
  }

  function renderSummary( summary ) {
    if ( !summary ) {
      return "";
    }

    if ( summary.photo ) {
      return `
        <aside class="discover-summary discover-summary--photo" aria-hidden="true">
          <figure class="discover-summary__photo">
            <img src="${ imageSrc( summary.photo ) }" alt="" />
          </figure>
        </aside>
      `;
    }

    const items = ( summary.items || [] )
      .map(
        ( item ) => `
          <li>
            <strong>${ escapeHtml( item.label ) }</strong>
            <span>${ escapeHtml( item.text ) }</span>
          </li>
        `
      )
      .join( "" );

    return `
      <aside class="discover-summary">
        <article class="discover-summary__card">
          ${ summary.kicker ? `<span class="section-kicker">${ escapeHtml( summary.kicker ) }</span>` : "" }
          ${ summary.title ? `<h3>${ escapeHtml( summary.title ) }</h3>` : "" }
          ${ summary.text ? `<p>${ escapeHtml( summary.text ) }</p>` : "" }
          ${ items ? `<ul class="discover-summary__meta">${ items }</ul>` : "" }
        </article>
      </aside>
    `;
  }

  function renderCardsSection( section ) {
    if ( !section ) {
      return "";
    }

    const cards = ( section.cards || [] )
      .map(
        ( card ) => `
          <article class="discover-commission-card">
            ${ iconMarkup( card.icon, "info-card__icon" ) }
            <h3>${ escapeHtml( card.title ) }</h3>
            <p>${ escapeHtml( card.text ) }</p>
          </article>
        `
      )
      .join( "" );

    return `
      <section class="section section--quick-links discover-section" id="${ escapeHtml( section.id ) }">
        <div class="container">
          <div class="section-heading">
            <h2>${ escapeHtml( section.title ) }</h2>
            <p>${ escapeHtml( section.intro ) }</p>
          </div>
          <div class="discover-commission-grid">${ cards }</div>
        </div>
      </section>
    `;
  }

  function renderFlowSection( section ) {
    if ( !section ) {
      return "";
    }

    const steps = ( section.steps || [] )
      .map(
        ( step ) => `
          <article class="discover-flow__card">
            <span class="discover-flow__step">${ escapeHtml( step.step ) }</span>
            <h3>${ escapeHtml( step.title ) }</h3>
            <p>${ escapeHtml( step.text ) }</p>
          </article>
        `
      )
      .join( "" );

    return `
      <section class="section section--stats discover-section" id="${ escapeHtml( section.id ) }">
        <div class="container">
          <div class="section-heading">
            <h2>${ escapeHtml( section.title ) }</h2>
            <p>${ escapeHtml( section.intro ) }</p>
          </div>
          <div class="discover-flow">${ steps }</div>
        </div>
      </section>
    `;
  }

  function renderClosing( closing ) {
    if ( !closing ) {
      return "";
    }

    const gallery = ( closing.gallery || [] )
      .slice( 0, 3 )
      .map( ( image ) => `<img src="${ imageSrc( image ) }" alt="" />` )
      .join( "" );

    const paragraphs = ( closing.paragraphs || [] )
      .map( ( paragraph ) => `<p>${ escapeHtml( paragraph ) }</p>` )
      .join( "" );

    return `
      <section class="section discover-section discover-section--closing">
        <div class="container discover-closing">
          <div class="discover-closing__gallery" aria-hidden="true">${ gallery }</div>
          <div class="discover-closing__copy">
            ${ closing.kicker ? `<span class="section-kicker">${ escapeHtml( closing.kicker ) }</span>` : "" }
            ${ closing.title ? `<h2>${ escapeHtml( closing.title ) }</h2>` : "" }
            ${ paragraphs }
            <div class="discover-closing__actions">
              ${
                closing.primary_cta
                  ? `<a class="button button--primary" href="${ escapeHtml( resolveTarget( closing.primary_cta.target ) ) }"><span>${ escapeHtml( closing.primary_cta.label ) }</span><span class="button__icon">${ icons.arrow }</span></a>`
                  : ""
              }
              ${
                closing.secondary_cta
                  ? `<a class="button button--secondary" href="${ escapeHtml( resolveTarget( closing.secondary_cta.target ) ) }"><span>${ escapeHtml( closing.secondary_cta.label ) }</span></a>`
                  : ""
              }
            </div>
          </div>
        </div>
      </section>
    `;
  }

  function markNavigation( page ) {
    const group = page.nav_group;

    document.querySelectorAll( ".primary-menu .current-menu-item" ).forEach( ( item ) => {
      item.classList.remove( "current-menu-item" );
    } );

    if ( group ) {
      const groupItem = document.querySelector( `[data-nav-group="${ group }"]` );
      if ( groupItem ) {
        groupItem.classList.add( "current-menu-item" );
      }
    }

    document.querySelectorAll( `[data-page-link="${ pageKey }"]` ).forEach( ( link ) => {
      const item = link.closest( "li" );
      if ( item ) {
        item.classList.add( "current-menu-item" );
      }
      const parent = link.closest( ".menu-item-has-children" );
      if ( parent ) {
        parent.classList.add( "current-menu-item" );
      }
    } );
  }

  fetch( pagesSrc )
    .then( ( response ) => response.json() )
    .then( ( pages ) => {
      const page = pages[ pageKey ];

      if ( !page ) {
        return;
      }

      document.title = page.title;

      const metaDescription = document.querySelector( 'meta[name="description"]' );
      if ( metaDescription && page.description ) {
        metaDescription.setAttribute( "content", page.description );
      }

      const heroImages = ( page.hero.images || [] )
        .slice( 0, 3 )
        .map(
          ( image, index ) => `
            <figure class="discover-media-card ${ [ "discover-media-card--primary", "discover-media-card--secondary", "discover-media-card--tertiary" ][ index ] }">
              <img src="${ imageSrc( image ) }" alt="" />
            </figure>
          `
        )
        .join( "" );

      const storyParagraphs = ( page.story.paragraphs || [] )
        .map( ( paragraph ) => `<p>${ escapeHtml( paragraph ) }</p>` )
        .join( "" );

      root.innerHTML = `
        <section class="page-hero discover-hero">
          <div class="container discover-hero__grid">
            <div class="discover-hero__copy">
              <h1>${ escapeHtml( page.title ) }</h1>
              <p class="discover-hero__lede">${ escapeHtml( page.hero.lede ) }</p>
              <div class="discover-hero__actions">
                <a class="button button--primary" href="${ escapeHtml( resolveTarget( page.hero.primary_cta.target ) ) }">
                  <span>${ escapeHtml( page.hero.primary_cta.label ) }</span>
                  <span class="button__icon">${ icons.arrow }</span>
                </a>
                <a class="button button--secondary" href="${ escapeHtml( resolveTarget( page.hero.secondary_cta.target ) ) }">
                  <span>${ escapeHtml( page.hero.secondary_cta.label ) }</span>
                </a>
              </div>
            </div>
            <div class="discover-hero__media" aria-hidden="true">${ heroImages }</div>
          </div>
        </section>

        <section class="section discover-section discover-section--story">
          <div class="container discover-story">
            <div class="discover-story__copy">
              <h2>${ escapeHtml( page.story.title ) }</h2>
              ${ storyParagraphs }
            </div>
            ${ renderSummary( page.story.summary ) }
          </div>
        </section>

        ${ renderCardsSection( page.cards_section ) }
        ${ renderFlowSection( page.flow_section ) }
        ${ renderClosing( page.closing ) }
      `;

      markNavigation( page );
    } )
    .catch( () => {
      root.innerHTML = "";
    } );
}() );
