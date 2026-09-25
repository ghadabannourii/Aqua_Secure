# 📋 INVENTAIRE DE MIGRATION — AQUASECURE REACT → LARAVEL BLADE

## 📅 Date d'analyse : 25 septembre 2026

---

## 🎯 VUE D'ENSEMBLE

### Frontend React existant
- **Framework** : React 18 + TypeScript + Vite
- **Styling** : Tailwind CSS 3.4 avec configuration custom
- **Icons** : Lucide React
- **État** : Context API (store.tsx)
- **Pages** : 4 pages principales
- **Composants** : 10+ composants UI réutilisables

### Destination Laravel
- **Version** : Laravel 12
- **Templating** : Blade
- **Styling** : Tailwind CSS (à configurer)
- **JavaScript** : Vanilla JS pour interactions
- **Assets** : Vite (Laravel Mix ou Vite)

---

## 📄 INVENTAIRE DES PAGES

### 1. Landing Page (Public)
**Fichier source** : `src/pages/LandingPage.tsx`
**Destination** : `resources/views/landing.blade.php`

**Sections** :
- ✅ Navigation avec logo + theme toggle
- ✅ Hero section avec RainEffect + WaveBackground
- ✅ Stats strip (3 KPIs)
- ✅ Concept section (3 piliers avec cards)
- ✅ Carte interactive du réseau (12 zones)
- ✅ Détail zone sélectionnée
- ✅ CTA section
- ✅ Footer

**Interactivité** :
- Theme toggle (dark/light)
- Hover sur zones carte
- Sélection zone
- Navigation entre sections

---

### 2. Auth Page
**Fichier source** : `src/pages/AuthPage.tsx`
**Destination** : `resources/views/auth/login.blade.php`, `register.blade.php`, `forgot-password.blade.php`

**Modes** :
- ✅ Login (connexion)
- ✅ Signup (inscription)
- ✅ Forgot password (récupération)

**Fonctionnalités** :
- 3 onglets mode auth
- Formulaires avec validation
- Champs : email, password, name, role, zone
- Show/hide password
- Comptes démo (4 types)
- RainEffect + WaveBackground
- Section info gauche (desktop only)

**Rôles disponibles** :
- Citizen (citoyen)
- Technician (technicien)
- Manager (gestionnaire)
- Admin (administrateur)

---

### 3. Citizen Space (FrontOffice Utilisateur)
**Fichier source** : `src/pages/CitizenSpace.tsx`
**Destination** : `resources/views/citizen/` (multiple vues)

**Onglets** :
1. **Signaler** (Report)
   - Formulaire 3 étapes
   - Étape 1 : Type incident + urgence
   - Étape 2 : Localisation (carte) + description
   - Étape 3 : Photo + récapitulatif
   - Types : Fuite, Coupure, Contamination, Pression, Compteur
   - Niveaux urgence : Faible, Moyenne, Élevée, Critique

2. **Mes signalements** (Track)
   - Liste incidents avec filtres (tous, reçu, en cours, résolu)
   - Timeline des updates par incident
   - Expansion au clic

3. **Notifications** (Notify)
   - Alerte sécheresse
   - Coupures programmées par zone
   - Infos météo

4. **Financement** (Finance)
   - Projets actifs
   - Barres progression (WaterProgress)
   - Budget total vs financé

**Navigation** :
- Top nav : Logo, badge "Espace Citoyen", theme toggle, profil, logout
- Tab bar sticky
- Bottom nav mobile

---

### 4. Manager Space (BackOffice Gestionnaire)
**Fichier source** : `src/pages/ManagerSpace.tsx`
**Destination** : `resources/views/manager/` (multiple vues)

**Onglets** :
1. **Tableau de bord** (Overview)
   - 4 KPI cards
   - LineChart consommation mensuelle
   - DonutChart état zones
   - BarChart incidents par type
   - Liste signalements récents

2. **Carte du réseau** (Map)
   - Carte interactive toutes zones
   - Détail zone sélectionnée
   - Table toutes zones (cliquable)

3. **Signalements** (Reports)
   - Filtres : type, urgence, statut, recherche
   - Table complète incidents
   - Pagination

4. **Projets** (Projects)
   - Vue Kanban / Liste toggle
   - 3 colonnes : Planifié, En cours, Terminé
   - Cards projets avec progression
   - Budget summary

5. **Statistiques** (Stats)
   - BarChart incidents mensuels
   - BarChart incidents résolus
   - LineChart consommation
   - Liste zones à risque

**Navigation** :
- Top nav : Logo, badge "Espace Gestionnaire", theme toggle
- Tab bar sticky

---

## 🧩 INVENTAIRE DES COMPOSANTS UI

### Composants réutilisables

#### 1. RippleButton
**Source** : `src/components/ui/RippleButton.tsx`
**Destination** : `resources/views/components/ripple-button.blade.php`
- Variantes : primary, secondary, ghost
- Tailles : sm, md, lg
- Effet ripple au clic

#### 2. Badge
**Source** : `src/components/ui/Badge.tsx`
**Destination** : `resources/views/components/badge.blade.php`
- Couleur personnalisable
- Texte + background + bordure

#### 3. Icon
**Source** : `src/components/ui/Icon.tsx`
**Destination** : `resources/views/components/icon.blade.php`
- Icons : Droplet, Waves, Gauge, PowerOff, FlaskConical, Meter
- Mapper avec Lucide ou équivalent

#### 4. WaterProgress
**Source** : `src/components/ui/WaterProgress.tsx`
**Destination** : `resources/views/components/water-progress.blade.php`
- Barre de progression animée effet eau
- Hauteur personnalisable
- Label + valeur optionnels

#### 5. DropLoader
**Source** : `src/components/ui/DropLoader.tsx`
**Destination** : `resources/views/components/drop-loader.blade.php`
- Animation loader goutte d'eau

#### 6. ToastContainer
**Source** : `src/components/ui/ToastContainer.tsx`
**Destination** : `resources/views/components/toast-container.blade.php`
- Types : success, error, info
- Position fixed top-right
- Dismiss button

#### 7. ProfileModal
**Source** : `src/components/ui/ProfileModal.tsx`
**Destination** : `resources/views/components/profile-modal.blade.php`
- À lire et migrer

#### 8. BarChart
**Source** : `src/components/ui/BarChart.tsx`
**Destination** : `resources/views/components/bar-chart.blade.php`
- Chart.js ou équivalent
- Couleur gradient

#### 9. LineChart
**Source** : `src/components/ui/LineChart.tsx`
**Destination** : `resources/views/components/line-chart.blade.php`
- Chart.js ou équivalent

#### 10. DonutChart
**Source** : `src/components/ui/DonutChart.tsx`
**Destination** : `resources/views/components/donut-chart.blade.php`
- Chart.js ou équivalent
- Valeur centrale

---

## 🎨 COMPOSANTS D'EFFETS VISUELS

### 1. RainEffect
**Source** : `src/components/effects/RainEffect.tsx`
**Destination** : `resources/views/components/rain-effect.blade.php`
- Gouttes animées
- Nombre configurable
- Position, vitesse, opacité aléatoires

### 2. WaveBackground
**Source** : `src/components/effects/WaveBackground.tsx`
**Destination** : `resources/views/components/wave-background.blade.php`
- 3 vagues SVG animées
- Animation horizontale infinie

---

## 🎨 CSS & ANIMATIONS

### Fichier source principal
**Source** : `src/index.css`
**Destination** : `resources/css/app.css`

### CSS Variables (thèmes)
```css
:root (dark theme) {
  --bg-primary: #061525
  --bg-secondary: #0a2740
  --bg-card: rgba(255, 255, 255, 0.065)
  --accent-cyan: #05bfdb
  --accent-turquoise: #2dd4bf
  ...
}

[data-theme='light'] {
  ...
}
```

### Classes custom essentielles
- `.glass` - effet glassmorphism
- `.glass-strong` - glassmorphism plus opaque
- `.wave-container` + `.wave-svg` - vagues
- `.rain-container` + `.raindrop` - pluie
- `.ripple-btn` + `.ripple-circle` - bouton ripple
- `.water-rise` + `.water-rise-fill` - progression eau
- `.route-enter` / `.route-sweep` - transitions pages
- `.hover-lift` - hover avec translation
- `.text-gradient` - texte dégradé
- `.zone-pulse-ring` - pulse zones carte
- `.timeline-line` - ligne timeline
- `.toast-drop` - animation toast
- `.input-field` - champs formulaire

### Animations clés
```css
@keyframes waveMove
@keyframes rainFall
@keyframes rippleExpand
@keyframes dropFill
@keyframes waterWave
@keyframes routeEnter
@keyframes sweepScreen
@keyframes fadeInUp
@keyframes fadeIn
@keyframes slideInRight
@keyframes scaleIn
@keyframes toastSlide
@keyframes pulseGlow
@keyframes zonePulse
@keyframes sensorPulse
```

---

## 📊 DONNÉES & TYPES

### Fichier source
**Source** : `src/data.ts` + `src/types.ts`
**Destination** : `app/Data/PlaceholderData.php` (temporaire)

### Structures principales

#### Users (7 utilisateurs démo)
- id, name, email, role, status, avatar, phone, zone, createdAt, lastLogin, passwordHash

#### Zones (14 zones)
- id, name, status (normal/alert/critical), x, y (position carte), sensors, consumption, quality, pressure

#### Incidents (8 incidents)
- id, type, urgency, status, location, lat, lng, description, date, reporter, reporterId, assignedTo, updates[]

#### Projects (6 projets)
- id, name, zone, status, budget, funded, startDate, endDate, progress, description, expenses[]

#### Scheduled Outages (4 coupures)
- id, zone, date, time, reason

#### KPI Data
- activeIncidents, resolutionRate, consumption, qualityIndex, totalReports, averageResponseTime

#### Monthly Stats (7 mois)
- month, incidents, resolved, consumption

#### Sensors (12 capteurs)
- id, zoneId, zoneName, type, status, lastReading, value, unit

#### Activities (5 activités)
- id, user, action, target, time, type

### Labels & Config
- incidentTypeLabels : { leak, outage, contamination, pressure, meter }
- urgencyLabels : { low, medium, high, critical }
- statusLabels : { received, in-progress, resolved }
- projectStatusLabels
- roleLabels
- userStatusLabels

### Helpers
- formatTND(amount) → "850 000 TND"
- formatDate(dateStr) → "15 sept. 2026"
- formatDateTime(dateStr) → "15 sept. 09:30"

---

## 🎨 CONFIGURATION TAILWIND

### Fichier source
**Source** : `tailwind.config.js`
**Destination** : `tailwind.config.js` (Laravel)

### Fonts custom
```js
fontFamily: {
  sans: ['Plus Jakarta Sans', 'sans-serif'],
  display: ['Space Grotesk', 'sans-serif'],
}
```

### Imports fonts
```css
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap');
```

---

## 📐 LAYOUTS BLADE À CRÉER

### 1. Layout principal (app.blade.php)
- HTML structure de base
- CSS/JS includes
- Theme data attribute
- Yield content

### 2. Layout FrontOffice (frontoffice.blade.php)
- Extends app
- Navigation citoyenne
- Footer

### 3. Layout BackOffice (manager.blade.php)
- Extends app
- Navigation gestionnaire
- Sidebar potentielle

### 4. Layout Auth (auth.blade.php)
- Extends app
- Background effects
- Centered content

---

## 🗂️ STRUCTURE BLADE PROPOSÉE

```
resources/views/
├── layouts/
│   ├── app.blade.php
│   ├── auth.blade.php
│   ├── frontoffice.blade.php
│   └── manager.blade.php
│
├── components/
│   ├── ripple-button.blade.php
│   ├── badge.blade.php
│   ├── icon.blade.php
│   ├── water-progress.blade.php
│   ├── drop-loader.blade.php
│   ├── toast-container.blade.php
│   ├── bar-chart.blade.php
│   ├── line-chart.blade.php
│   ├── donut-chart.blade.php
│   ├── rain-effect.blade.php
│   ├── wave-background.blade.php
│   └── profile-modal.blade.php
│
├── landing.blade.php
│
├── auth/
│   ├── login.blade.php
│   ├── register.blade.php
│   └── forgot-password.blade.php
│
├── citizen/
│   ├── dashboard.blade.php
│   ├── report.blade.php
│   ├── track.blade.php
│   ├── notifications.blade.php
│   └── financing.blade.php
│
└── manager/
    ├── dashboard.blade.php
    ├── map.blade.php
    ├── reports.blade.php
    ├── projects.blade.php
    └── statistics.blade.php
```

---

## 🎨 PALETTE DE COULEURS

### Dark Theme (défaut)
- Background primary : `#061525`
- Background secondary : `#0a2740`
- Accent cyan : `#05bfdb`
- Accent turquoise : `#2dd4bf`
- Accent blue : `#088395`
- Positive (success) : `#2dd4bf`
- Warning : `#fbbf24`
- Critical (error) : `#fb7185`

### Light Theme
- Background primary : `#eefcff`
- Background secondary : `#d8f3fa`
- Accent cyan : `#0891b2`

### Status colors
- Normal : `#2dd4bf`
- Alert : `#fbbf24`
- Critical : `#ef4444`

---

## 🔧 INTERACTIONS JAVASCRIPT NÉCESSAIRES

### 1. Theme Toggle
- Toggle data-theme attribute
- LocalStorage persistence

### 2. Tabs Navigation
- Active tab state
- Content switching

### 3. Modals
- Open/close modal
- Backdrop click close
- ESC key close

### 4. Dropdown
- Toggle visibility
- Outside click close

### 5. Forms
- Multi-step form navigation
- Validation feedback
- Photo upload preview

### 6. Map Interaction
- Zone selection
- Hover effects
- Display zone details

### 7. Filters
- Table/list filtering
- Search functionality

### 8. Toast Notifications
- Show toast
- Auto-dismiss (5s)
- Manual dismiss

### 9. Ripple Effect
- Click position calculation
- Animation trigger

### 10. Charts
- Chart.js initialization
- Responsive resize
- Data update

---

## 📦 DÉPENDANCES NÉCESSAIRES

### CSS
- ✅ Tailwind CSS 3.4+
- ✅ Fonts : Plus Jakarta Sans, Space Grotesk

### JavaScript
- ✅ Chart.js (graphiques)
- ✅ Lucide icons ou alternative SVG

### Laravel
- ✅ Laravel 12
- ✅ Vite ou Laravel Mix
- ❌ PAS de Breeze/Jetstream (UI uniquement)

---

## ⚠️ POINTS D'ATTENTION

### 1. Animations CSS
- Toutes les animations doivent être reproduites
- Keyframes complexes (waves, rain, ripple)
- Transitions fluides

### 2. Responsive
- Mobile first
- Breakpoints : sm, md, lg
- Bottom nav mobile pour citizen/manager

### 3. Accessibilité
- aria-label sur boutons
- focus-visible states
- Keyboard navigation

### 4. Performance
- Lazy load des composants lourds
- Optimize SVG
- CSS critique inline

### 5. Thèmes
- Dark (défaut) / Light toggle
- CSS variables
- Persistence localStorage

---

## 🚀 ORDRE DE MIGRATION RECOMMANDÉ

1. ✅ **Analyser** (FAIT)
2. ⬜ Configurer Tailwind + Fonts
3. ⬜ Créer layouts Blade de base
4. ⬜ Migrer CSS custom + animations
5. ⬜ Créer composants UI de base (Button, Badge, Icon)
6. ⬜ Créer composants effets (Rain, Wave)
7. ⬜ Migrer Landing Page
8. ⬜ Migrer Auth Pages
9. ⬜ Migrer Citizen Space
10. ⬜ Migrer Manager Space
11. ⬜ Créer composants Charts
12. ⬜ Implémenter JavaScript interactions
13. ⬜ Créer données placeholders
14. ⬜ Tests responsive
15. ⬜ Documentation finale

---

## 📝 NOTES IMPORTANTES

### ✅ À FAIRE
- Migration UI complète
- Préservation design exact
- Tous les composants réutilisables
- Toutes les animations
- Responsive complet
- Données placeholders pour démo

### ❌ À NE PAS FAIRE
- Models Laravel
- Migrations database
- Controllers métier
- Services
- Form Requests
- Authentification backend
- Autorisation backend
- API routes
- Business logic
- CRUD backend

### 🎯 OBJECTIF FINAL
Frontend Blade complet, pixel-perfect avec le React existant, prêt à recevoir le backend Laravel développé séparément.

---

## 📊 STATISTIQUES

- **Pages** : 4 principales (Landing, Auth, Citizen, Manager)
- **Vues Blade estimées** : ~15
- **Composants UI** : 10+
- **Composants effets** : 2
- **Animations CSS** : 15+
- **Interactions JS** : 10+
- **Lignes CSS custom** : ~800
- **Types TypeScript** : ~15
- **Données placeholders** : 7 collections

---

**Document généré le 25 septembre 2026**
**Prêt pour la migration React → Laravel Blade**
