  /**
   * Use this class if you want to make call to the API
   * @type {API}
   */
  window.API = new class
  {
     constructor()
     {
        this.vue = new Vue();
        this.vue.data = {
           data: null,
        }
     }
     version()
     {
        return '';
     }

     put(base, data, success, failure = null)
        {
           return axios.put(this.version() + base, data).then((response) =>
           {
              success(response);
           }, failure);
        }
        /**
         * Simple wrapper for vue delete request
         * @param  {[base]} api route
         * @param  {[id]} object id
         * @return {[void]}
         */
     delete(base, id)
        {
           axios.delete(this.version() + base + '/' + id,
           {}).then(function()
           {
              // Notifier.notify('success', 'Gelukt!', 'Verwijderd');
           }, function()
           {
              // Notifier.notify('failed', 'Mislukt', 'Verwijderd');
           });
        }

        /**
         * Simple wrapper for vue get request.
         * @param  {[base]}
         * @return {[vue http request]}
         */
     post(base, success, failure = null, parameters = {})
        {
           return axios.post(this.version() + base, parameters).then(function(response)
           {
              var data = response.data;
              success(data);
           }, failure);
        }
        /**
         * Simple wrapper for vue get request.
         * @param  {[base]}
         * @return {[vue http request]}
         */
     get(base, success, failure = null, $parameters = {})
     {
        return axios.get(this.version() + base, $parameters).then(function(response)
        {
           var data = response.data;
           if (success.constructor === Array)
           {
              success.forEach(function(callback)
              {
                 callback(data);
              });
           }
           else
           {
              success(data);
           }
        }, failure);
     }
  }