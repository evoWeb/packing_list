'use strict';

export class Fetch {
  protected onFulfillment: Function[] = [];

  protected onError: Function[] = [];

  protected onCompletion: Function[] = [];

  constructor(url: string, options?: {method: string}) {
    let xhr = new XMLHttpRequest();
    let method = 'GET' || options.method;
    let internalFetchContext = this;

    xhr.onreadystatechange = function () {
      let _data = this;
      if (this.readyState == 4 && this.status == 200) {
        // Action to be performed when the document is read;
        internalFetchContext.onFulfillment.forEach(function (callback: Function) {
          callback(_data);
        });
        internalFetchContext.onCompletion.forEach(function (callback: Function) {
          callback(_data);
        });
      } else if (this.readyState == 4 && this.status !== 200) {
        internalFetchContext.onError.forEach(function (callback: Function) {
          callback(_data);
        });
        internalFetchContext.onCompletion.forEach(function (callback: Function) {
          callback(_data);
        });
      }
    };
    xhr.open(method, url, true);
    xhr.send();
  }

  then(this: Fetch, fulfillmentFunction: Function) {
    this.onFulfillment.push(fulfillmentFunction);
    return this;
  };

  catch(this: Fetch, errorFunction: Function) {
    this.onError.push(errorFunction);
    return this;
  };

  finally(this: Fetch, completionFunction: Function) {
    this.onCompletion.push(completionFunction);
    return this;
  };
}
