<template>
  <b-card-code title="">
    <validation-observer ref="simpleRules">
      <b-form ref="fundForm" id="fundForm" @submit.prevent="submitForm">
        <b-row>
          <b-col md="3">
            <b-form-group label="Name" label-for="fund-name">
              <validation-provider #default="{ errors }" name="Fund Name" rules="required">
                <b-form-input id="fund-name" v-model="fundName" name="name" :state="errors.length > 0 ? false:null"
                  placeholder="Fund Name" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <b-col md="3">
            <b-form-group label="Currency" label-for="fund-currency" invalid-feedback="Currency is required">
              <validation-provider #default="{ errors }" name="Fund Currency" rules="required">
                <b-form-select :options="currencies" name="currency" v-model="fundCurrency"
                  :state="errors.length > 0 ? false:null" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <b-col md="3">
            <b-form-group label="Type" label-for="fund-type" invalid-feedback="Type is required">
              <validation-provider #default="{ errors }" name="Fund Type" rules="required">
                <b-form-select :options="types" name="type" v-model="fundType"
                  :state="errors.length > 0 ? false:null" />
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
        <b-row v-for="(userFundFieldGroup, groupIndex) in userSetFundFieldGroups" :key="groupIndex">
          <b-col md="12" class="my-2">
            <h4>{{userFundFieldGroup.group_name}}</h4>
          </b-col>

          <b-col md="3" v-for="(fundField, fundFieldIndex) in userFundFieldGroup.fund_fields" :key="fundFieldIndex">
            <b-form-group v-if="fundField.field_type.name == 'Dropdown' && fundField.field_type.resource == 'country'"
              :label="fundField.name" :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <b-form-select v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value" :options="countries"
                  :state="errors.length > 0 ? false:null" :name="'fund_' + fundField.id" :id="fundField.slug" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="fundField.field_type.name == 'Dropdown'" :label="fundField.name"
              :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <b-form-select v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value"
                  :options="fundField.dropdown.data.list" :state="errors.length > 0 ? false:null"
                  :name="'fund_' + fundField.id" :id="fundField.slug" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="fundField.field_type.name == 'Boolean'" :label="fundField.name"
              :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <b-form-checkbox v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value" checked="false"
                  :id="fundField.slug" :name="'fund_' + fundField.id" switch inline>
                  {{ fundField.name }}
                </b-form-checkbox>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="fundField.field_type.name == 'Date'" :label="fundField.name"
              :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <flat-pickr v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value"
                  :name="'fund_' + fundField.id" class="form-control" :id="fundField.slug" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="fundField.field_type.name == 'Number'" :label="fundField.name"
              :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <b-form-input :name="'fund_' + fundField.id"
                  v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value" :id="fundField.slug" type="number"
                  placeholder="0" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="fundField.field_type.name == 'Text'" :label="fundField.name"
              :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <b-form-textarea v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value" :id="fundField.slug"
                  :placeholder="fundField.field_type.name" :name="'fund_' + fundField.id" rows="3" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="fundField.field_type.name == 'Serial Number'" :label="fundField.name"
              :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <b-form-input :id="fundField.slug" :placeholder="fundField.field_type.name"
                  :name="'fund_' + fundField.id" v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value"
                  :state="errors.length > 0 ? false:null" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else-if="fundField.field_type.name == 'Autocomplete'" :label="fundField.name"
              :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <b-form-input :id="fundField.slug" :placeholder="fundField.name" :name="'fund_' + fundField.id"
                  v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value"
                  :state="errors.length > 0 ? false:null" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
            <b-form-group v-else :label="fundField.name" :label-for="fundField.slug">
              <validation-provider #default="{ errors }" :name="fundField.name"
                :rules="fundField.isRequired ? 'required' : ''">
                <b-form-input :id="fundField.slug" :placeholder="fundField.name" :name="'fund_' + fundField.id"
                  v-model="validFundFieldGroups[groupIndex][fundFieldIndex].value"
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
      types: [],
      userSetFundFieldGroups: [],
      validFundFieldGroups: [],
      fundName: '',
      fundCurrency: null,
      fundType: null,
      legalName: ''
    }
  },
  created() {
    this.$http.get('/api/fund/create')
      .then(res => {
        this.types = res.data.fund_type.map(each => {
          return {
            'text': each.type,
            'value': each.id
          }
        })

        this.userSetFundFieldGroups = res.data.userSetFundFieldGroups

        this.validFundFieldGroups = res.data.userSetFundFieldGroups.map(each => {
          const validFundFields = each.fund_fields.map(eachFundField => {
            return {
              value: ''
            }
          })
          return validFundFields
        })
        console.log(this.validFundFieldGroups)
      })
  },
  methods: {
    submitForm() {
      this.$refs.simpleRules.validate().then(success => {
        if (success) {
          // eslint-disable-next-line
          // this.$refs.fundForm.submit();
          const formData = new FormData(document.getElementById('fundForm'))
          this.$http.post('/api/fund', formData)
            .then(res => {
              if (res.data) {
                this.$router.replace({ name: 'entities-fund-list' }).then(() => {
                  this.$toast({
                    component: ToastificationContent,
                    position: 'top-right',
                    props: {
                      title: `Information`,
                      icon: 'CoffeeIcon',
                      variant: 'success',
                      text: `New fund created!!!`,
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
