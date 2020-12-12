import {Fetch} from '../Utility/Fetch';

export class ShareController {
  protected modal: HTMLDivElement;

  protected message: HTMLParagraphElement;

  protected acceptButton: HTMLLinkElement;

  protected instance: M.Modal;

  protected shareLinks: Array<HTMLLinkElement>;

  protected shareLink: HTMLLinkElement;

  constructor() {
    this.initializeModal();
    this.initializeShareLinks();
  }

  initializeModal() {
    this.modal = window.document.querySelector('#shareModal');
    this.message = this.modal.querySelector('.modal-content p');
    this.acceptButton = this.modal.querySelector('.modal-footer .green');
    this.acceptButton.addEventListener('click', this.acceptButtonClicked.bind(this));
    this.instance = M.Modal.init(this.modal, {dismissible: false});
  }

  initializeShareLinks() {
    this.shareLinks = [].slice.call(window.document.querySelectorAll('.share-link'));
    this.shareLinks.forEach((shareLink) => {
      shareLink.addEventListener('click', this.linkClicked.bind(this));
    });
  }

  linkClicked(this: ShareController, event: Event) {
    event.preventDefault();

    const shareLink = event.currentTarget as HTMLLinkElement;

    this.message.innerHTML = shareLink.dataset['message'];
    this.acceptButton.innerHTML = shareLink.dataset['ok'];

    if (shareLink.dataset['uri'] !== undefined) {
      this.acceptButton.dataset['action'] = 'share';
      this.acceptButton.dataset['uri'] = shareLink.dataset['uri'];
    } else {
      this.acceptButton.dataset['action'] = 'copy';
      this.acceptButton.dataset['uri'] = shareLink.href;
    }

    this.openModal();
  }

  openModal(this: ShareController) {
    this.instance.open();
  }

  acceptButtonClicked(this: ShareController) {
    if (this.acceptButton.dataset['action'] == 'share') {
      this.enableSharingViaAjax(this.acceptButton.dataset['uri']);
    } else {
      this.copyToClipboard(this.acceptButton.dataset['uri']);
    }
  }

  enableSharingViaAjax(this: ShareController, uri: string) {
    new Fetch(uri).then(this.processResponse.bind(this));
  }

  processResponse(this: ShareController, response: XMLHttpRequest) {
    const data = JSON.parse(response.responseText);

    this.message.innerHTML = data['message'];
    this.acceptButton.innerHTML = data['ok'];
    this.acceptButton.dataset['action'] = 'copy';
    this.acceptButton.dataset['uri'] = data['href'];

    this.openModal();
  }

  copyToClipboard(this: ShareController, uri: string) {
    const temporaryElement = document.createElement('textarea') as HTMLTextAreaElement;
    temporaryElement.value = uri;
    document.body.appendChild(temporaryElement);
    temporaryElement.select();
    document.execCommand('copy');
    document.body.removeChild(temporaryElement);
  };
}
