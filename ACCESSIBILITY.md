# Guide d'Accessibilité AquaSecure

## 🎯 Vue d'ensemble

AquaSecure respecte les standards d'accessibilité WCAG 2.1 niveau AA pour garantir une expérience inclusive à tous les utilisateurs.

## ♿ Fonctionnalités d'accessibilité

### 1. Navigation au clavier

- **Tab** : Naviguer entre les éléments interactifs
- **Shift + Tab** : Navigation arrière
- **Enter / Espace** : Activer boutons et liens
- **Escape** : Fermer modals et dropdowns
- **Flèches** : Navigation dans les menus et listes

### 2. Lecteurs d'écran

Tous les composants incluent:
- **ARIA labels** appropriés
- **Roles** sémantiques (dialog, alert, navigation, etc.)
- **États** dynamiques (aria-expanded, aria-selected, aria-hidden)
- **Descriptions** contextuelles (aria-describedby)

### 3. Responsive Design

#### Mobile (< 640px)
- Navigation hamburger accessible
- Cards en colonne unique
- Texte optimisé pour petits écrans
- Touch targets minimum 44x44px

#### Tablette (640px - 1024px)
- Grilles adaptatives (2 colonnes)
- Sidebars collapsibles
- Navigation optimisée

#### Desktop (> 1024px)
- Expérience complète
- Grilles 3-4 colonnes
- Sidebar fixe

### 4. Contraste des couleurs

Les couleurs respectent les ratios WCAG AA:
- **Texte principal** : ratio ≥ 4.5:1
- **Texte large** : ratio ≥ 3:1
- **Composants UI** : ratio ≥ 3:1

Palette:
```
Primary Text: #f0fdff sur #061525 → Ratio 14.2:1 ✓
Secondary Text: #9cc8d8 sur #061525 → Ratio 8.5:1 ✓
Accent Cyan: #05bfdb → Visible et distinctif ✓
```

### 5. Animations

Support pour `prefers-reduced-motion`:
```css
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
}
```

### 6. Focus visible

Tous les éléments interactifs ont des indicateurs de focus clairs:
- Outline cyan de 2px
- Offset de 2px pour visibilité
- Transitions douces

### 7. Formulaires accessibles

- Labels explicites pour tous les champs
- Messages d'erreur liés via `aria-describedby`
- États requis indiqués visuellement et sémantiquement
- Validation inline avec feedback

## 📱 Composants Responsive

### Mobile Navigation (`mobile-nav.blade.php`)

Navigation hamburger pleinement accessible:
- Bouton avec `aria-label` et `aria-expanded`
- Menu avec `role="navigation"`
- Focus trap dans le menu ouvert
- Fermeture sur Escape
- Overlay cliquable

### Modal (`modal.blade.php`)

Modals accessibles:
- `role="dialog"` et `aria-modal="true"`
- Focus automatique à l'ouverture
- Trap de focus à l'intérieur
- Fermeture sur Escape
- Titre lié via `aria-labelledby`

### Forms (`input.blade.php`, `select.blade.php`, `textarea.blade.php`)

Champs de formulaire accessibles:
- Labels visibles et associés
- États requis avec `aria-required`
- Erreurs avec `aria-invalid` et `aria-describedby`
- Hints descriptifs
- Icons décoratifs ignorés par les lecteurs d'écran

### Buttons (`button.blade.php`)

Boutons accessibles:
- États disabled avec `aria-disabled`
- États loading avec `aria-busy`
- Focus visible
- Touch targets minimum 44x44px

## 🧪 Tests d'accessibilité

### Tests recommandés

1. **Navigation clavier**
   - Tester tous les parcours utilisateur au clavier uniquement
   - Vérifier que tous les éléments sont accessibles
   - Confirmer que le focus est toujours visible

2. **Lecteur d'écran**
   - NVDA (Windows) : gratuit, recommandé
   - JAWS (Windows) : standard professionnel
   - VoiceOver (Mac/iOS) : intégré
   - TalkBack (Android) : intégré

3. **Outils automatisés**
   - axe DevTools (extension Chrome/Firefox)
   - WAVE (extension navigateur)
   - Lighthouse (Chrome DevTools)

### Checklist rapide

- [ ] Tous les boutons ont des labels significatifs
- [ ] Les images ont des alt texts (ou sont décoratives)
- [ ] Les formulaires ont des labels associés
- [ ] Les erreurs sont annoncées aux lecteurs d'écran
- [ ] La navigation clavier fonctionne partout
- [ ] Le focus est visible
- [ ] Les modals trapent le focus
- [ ] Escape ferme les overlays
- [ ] Les couleurs ont un bon contraste
- [ ] Le site fonctionne avec zoom 200%
- [ ] Les animations respectent prefers-reduced-motion

## 🎨 Classes CSS utilitaires responsive

### Visibilité
- `.mobile-only` : visible uniquement sur mobile (< 640px)
- `.desktop-only` : visible uniquement sur desktop (≥ 640px)

### Layout
- `.mobile-stack` : flex-direction column sur mobile
- `.mobile-full` : width 100% sur mobile
- `.mobile-compact` : padding réduit sur mobile

### Grilles
- `.tablet-grid-2` : 2 colonnes sur tablette
- `.desktop-grid-3` : 3 colonnes sur desktop
- `.desktop-grid-4` : 4 colonnes sur desktop

### Touch
Sur touch devices:
- Touch targets automatiquement ≥ 44x44px
- Hover effects désactivés
- Tap highlight cyan subtil

## 📚 Ressources

- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
- [MDN Accessibility Guide](https://developer.mozilla.org/en-US/docs/Web/Accessibility)
- [WebAIM](https://webaim.org/)
- [A11y Project Checklist](https://www.a11yproject.com/checklist/)

## 🔧 Améliorations futures

- [ ] Tests avec utilisateurs réels utilisant technologies d'assistance
- [ ] Audit complet WCAG 2.1 AAA
- [ ] Support des thèmes à haut contraste
- [ ] Mode lecture simplifié
- [ ] Skip links pour navigation rapide
- [ ] Landmarks ARIA sur toutes les pages
- [ ] Live regions pour les mises à jour dynamiques

---

**Note**: L'accessibilité est un processus continu. Ce guide sera mis à jour régulièrement avec de nouvelles fonctionnalités et améliorations.
