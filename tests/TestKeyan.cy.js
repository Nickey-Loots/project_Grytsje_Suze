// =============================================================================
// tests/TestKeyan.cy.js
// Cypress E2E tests — Grytsje Suze website
// Voer uit met: npx cypress open  (daarna kies dit bestand in de GUI)
// Zorg dat de PHP-server draait op http://localhost:8000
// =============================================================================

describe('Homepage', () => {
  beforeEach(() => {
    cy.visit('/');
  });

  it('laadt de homepage', () => {
    cy.title().should('include', 'Grytsje Suze');
  });

  it('toont de hero-slogan', () => {
    cy.contains('Design made to be seen').should('be.visible');
  });

  it('heeft een navigatiebalk', () => {
    cy.get('nav').should('exist');
  });
});

describe('Portfolio pagina', () => {
  beforeEach(() => {
    cy.visit('/portfolio');
  });

  it('laadt de portfoliopagina', () => {
    cy.title().should('include', 'Portfolio');
  });

  it('toont een lijst van tassen', () => {
    cy.get('main').should('exist');
  });
});

describe('About pagina', () => {
  beforeEach(() => {
    cy.visit('/about');
  });

  it('laadt de about-pagina', () => {
    cy.title().should('include', 'About');
  });
});

describe('Collaborations pagina', () => {
  beforeEach(() => {
    cy.visit('/collaborations');
  });

  it('laadt de collaborations-pagina', () => {
    cy.get('main').should('exist');
  });
});

describe('Commissions pagina', () => {
  beforeEach(() => {
    cy.visit('/commissions');
  });

  it('laadt de commissions-pagina', () => {
    cy.get('main').should('exist');
  });
});

describe('News pagina', () => {
  beforeEach(() => {
    cy.visit('/news');
  });

  it('laadt de news-pagina', () => {
    cy.get('main').should('exist');
  });
});

describe('Contact pagina', () => {
  beforeEach(() => {
    cy.visit('/contact');
  });

  it('laadt de contactpagina', () => {
    cy.get('main').should('exist');
  });

  it('heeft een contactformulier', () => {
    cy.get('form').should('exist');
  });
});

describe('Admin login pagina', () => {
  beforeEach(() => {
    cy.visit('/admin/login');
  });

  it('toont het loginformulier', () => {
    cy.get('form').should('exist');
  });

  it('heeft een wachtwoord veld', () => {
    cy.get('input[type="password"]').should('exist');
  });
});
