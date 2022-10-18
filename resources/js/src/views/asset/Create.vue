<template>
  <b-card-code title="">
    <validation-observer ref="simpleRules">
      <b-form ref="assetForm" id="assetForm" @submit.prevent="submitForm">
        <b-row>
          <b-col md="3">
            <b-form-group label="Name" label-for="asset-name">
              <validation-provider #default="{ errors }" name="Asset Name" rules="required">
                <b-form-input id="asset-name" v-model="assetName" name="name" :state="errors.length > 0 ? false:null"
                  placeholder="Asset Name" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <b-col md="3">
            <b-form-group label="Legal Name" label-for="legal-name">
              <validation-provider #default="{ errors }" name="Legal Name" rules="required">
                <b-form-input id="legal-name" name="legal_name" v-model="legalName" placeholder="Legal Name"
                  :state="errors.length > 0 ? false:null" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!-- <b-col md="3">
            <b-form-group label-for="mc-email" label="Email">
              <div class="form-label-group">
                <b-form-input id="mc-email" type="email" placeholder="Email" />
              </div>
            </b-form-group>
          </b-col> -->

          <!-- submit and reset -->
        </b-row>
        <b-row v-for="(userAssetFieldGroup, groupIndex) in userSetAssetFieldGroups" :key="groupIndex">
          <b-col md="12" class="my-2">
            <h4>{{userAssetFieldGroup.group_name}}</h4>
          </b-col>

          <b-col md="3" v-for="(assetField, assetFieldIndex) in userAssetFieldGroup.asset_fields"
            :key="assetFieldIndex">
            <b-form-group v-if="assetField.field_type.name == 'Dropdown' && assetField.field_type.resource == 'country'"
              :label="assetField.name" :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <b-form-select v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value" :options="countries"
                  :state="errors.length > 0 ? false:null" :name="'asset_' + assetField.id" :id="assetField.slug" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="assetField.field_type.name == 'Dropdown'" :label="assetField.name"
              :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <b-form-select v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value"
                  :options="assetField.dropdown.data.list" :state="errors.length > 0 ? false:null"
                  :name="'asset_' + assetField.id" :id="assetField.slug" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="assetField.field_type.name == 'Boolean'" :label="assetField.name"
              :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <b-form-checkbox v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value" checked="false"
                  :id="assetField.slug" :name="'asset_' + assetField.id" switch inline>
                  {{ assetField.name }}
                </b-form-checkbox>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="assetField.field_type.name == 'Date'" :label="assetField.name"
              :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <flat-pickr v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value"
                  :name="'asset_' + assetField.id" class="form-control" :id="assetField.slug" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="assetField.field_type.name == 'Number'" :label="assetField.name"
              :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <b-form-input :name="'asset_' + assetField.id"
                  v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value" :id="assetField.slug" type="number"
                  placeholder="0" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="assetField.field_type.name == 'Text'" :label="assetField.name"
              :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <b-form-textarea v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value"
                  :id="assetField.slug" :placeholder="assetField.field_type.name" :name="'asset_' + assetField.id"
                  rows="3" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="assetField.field_type.name == 'Serial Number'" :label="assetField.name"
              :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <b-form-input :id="assetField.slug" :placeholder="assetField.field_type.name"
                  :name="'asset_' + assetField.id" v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value"
                  :state="errors.length > 0 ? false:null" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="assetField.field_type.name == 'Autocomplete'" :label="assetField.name"
              :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <b-form-input :id="assetField.slug" :placeholder="assetField.name" :name="'asset_' + assetField.id"
                  v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value"
                  :state="errors.length > 0 ? false:null" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else :label="assetField.name" :label-for="assetField.slug">
              <validation-provider #default="{ errors }" :name="assetField.name"
                :rules="assetField.isRequired ? 'required' : ''">
                <b-form-input :id="assetField.slug" :placeholder="assetField.name" :name="'asset_' + assetField.id"
                  v-model="validAssetFieldGroups[groupIndex][assetFieldIndex].value"
                  :state="errors.length > 0 ? false:null" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!-- <b-col md="3">
                    <b-form-group label-for="mc-email" label="Email">
                      <div class="form-label-group">
                        <b-form-input id="mc-email" type="email" placeholder="Email" />
                      </div>
                    </b-form-group>
                  </b-col> -->

          <!-- submit and reset -->
        </b-row>
        <b-row>
          <b-col md="12">
            <b-button variant="primary" type="submit">
              Submit
            </b-button>
          </b-col>
        </b-row>
      </b-form>
    </validation-observer>

  </b-card-code>
</template>

<script>
import BCardCode from '@core/components/b-card-code'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BRow, BCol, BFormGroup, BFormInput, BFormCheckbox, BForm, BButton, BFormSelect, BFormSpinbutton, BFormTextarea
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import flatPickr from 'vue-flatpickr-component'
import { currency } from '@/libs/constant/currency'
import { country } from '@/libs/constant/country'
import { required } from '@validations'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BCardCode,
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
    BForm,
    BButton,
    BFormSelect,
    BFormTextarea,
    BFormSpinbutton,
    ValidationProvider,
    ValidationObserver,
    flatPickr,
    required
  },
  directives: {
    Ripple,
  },
  data() {
    const currencies = []
    for (const key in currency) {
      currencies[currencies.length] = {
        value: key,
        text: key
      }
    }

    const countries = []
    for (const key in country) {
      countries[countries.length] = {
        value: country[key].code,
        text: country[key].code
      }
    }

    return {
      currencies: currencies,
      countries: countries,
      userSetAssetFieldGroups: [],
      validAssetFieldGroups: [],
      assetName: '',
      assetCurrency: null,
      assetType: null,
      legalName: ''
    }
  },
  created() {
    this.$http.get('/api/asset/create')
      .then(res => {
        this.userSetAssetFieldGroups = res.data.userSetAssetFieldGroups

        this.validAssetFieldGroups = res.data.userSetAssetFieldGroups.map(each => {
          const validAssetFields = each.asset_fields.map(eachAssetField => {
            return {
              value: ''
            }
          })
          return validAssetFields
        })
        console.log(this.validAssetFieldGroups)
      })
  },
  methods: {
    submitForm() {
      this.$refs.simpleRules.validate().then(success => {
        if (success) {
          // eslint-disable-next-line
          // this.$refs.assetForm.submit();
          const formData = new FormData(document.getElementById('assetForm'))
          this.$http.post('/api/asset', formData)
            .then(res => {
              if (res.data) {
                this.$router.replace({ name: 'entities-asset-list' }).then(() => {
                  this.$toast({
                    component: ToastificationContent,
                    position: 'top-right',
                    props: {
                      title: `Information`,
                      icon: 'CoffeeIcon',
                      variant: 'success',
                      text: `New asset created!!!`,
                    },
                  })
                })
              }
            })
        }
      })
    },
  },
}
</script>
