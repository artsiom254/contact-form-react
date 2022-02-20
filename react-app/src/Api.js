import Axios from 'axios';

const wpApiHost = document.getElementById('root_cf').getAttribute('data-api')
const wpApiUrl = wpApiHost+'cf/v1/entry/'

const Api = {

    getVariables()
    {
        return Axios.get(wpApiUrl+'variables')
            .then((response) => {
                return JSON.parse(response.data)
            }, (error) => {
                window.console.log('error of retrieving variables ')
                window.console.log(error)
            })
    },

    createEntry(data)
    {
        let params = {
          entry_subject: data.subject,
        }

        return Axios.post(wpApiUrl+'create', params)
            .then((response) => {
                return response.data;
            }, (error) => {
                window.console.log('entry error')
                window.console.log(error)
            })
    },
}

export default Api
