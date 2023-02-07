/**
 * Simple RESTful resource class
 */
import axiosIns from '@/libs/axios';

const request = axiosIns;

// this.$http. it is axios with all header configurations and request and response interceptors
// https://vuejs.org/v2/cookbook/adding-instance-properties.html

class Resource {
  constructor(uri) {
    this.uri = uri;
  }

  list(query) {
    return request({
      url: '/' + this.uri,
	  method: 'get',
      params: query,
    });
  }

  get(id) {
    return request({
      url: '/' + this.uri + '/' + id,
      method: 'get',
    });
  }
  store(resource) {
    return request({
      url: '/' + this.uri,
      method: 'post',
      data: resource,
    });
  }
  update(id, resource) {
    return request({
      url: '/' + this.uri + '/' + id,
      method: 'put',
      data: resource,
    });
  }
  destroy(id) {
    return request({
      url: '/' + this.uri + '/' + id,
      method: 'delete',
    });
  }
}

export { Resource as default };
