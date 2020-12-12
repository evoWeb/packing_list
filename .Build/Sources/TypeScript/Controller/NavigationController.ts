export class NavigationController {
  constructor() {
    const elements = window.document.querySelectorAll('.dropdown-trigger');
    const instances = M.Dropdown.init(elements, { hover: false, alignment: 'right' });
  }
}
