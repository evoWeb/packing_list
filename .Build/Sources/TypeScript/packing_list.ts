import {ShareController} from './Controller/ShareController'
import {NavigationController} from './Controller/NavigationController'

export default class PackingList {
  constructor() {
    new ShareController();
    new NavigationController();
  }
}

new PackingList();
