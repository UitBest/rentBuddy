<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card
                    :loading="loading"
                    title="List all cities"
                >
                    <v-card-text>
                        <v-combobox
                            v-model="previewCity"
                            item-title="name"
                            :items="indexCities"
                            label="Cities"
                        />
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col
                cols="12"
                md="6"
            >
                <v-card
                    :loading="loading"
                    title="New City"
                >
                    <v-card-text>
                        <v-text-field
                            v-model="newCity.name"
                            label="Name"
                        />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            color="primary"
                            @click="newCity.onSuccess(fetchCities).save()"
                        >
                            Create
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
            <v-col
                cols="12"
                md="6"
            >
                <v-card
                    :loading="loading"
                    :title="`Preview City - ${previewCity.name}`"
                >
                    <v-card-text>
                        <v-text-field
                            v-model="previewCity.name"
                            label="Name"
                        />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            color="primary"
                            @click="previewCity.onSuccess(fetchCities).save()"
                        >
                            Update
                        </v-btn>
                        <v-btn
                            color="error"
                            @click="previewCity.destroy()"
                        >
                            Delete
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card
                    :loading="loading"
                    title="All cities"
                >
                    <v-data-table
                        :headers="[
                            {
                                title: 'Name',
                                key: 'name',
                            },
                            {
                                title: 'Addresses',
                                key: 'addresses.length',
                                align: 'end',
                            },
                        ]"
                        :items="indexCities"
                        items-per-page="5"
                    />
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card
                    :loading="loading"
                    title="List all addresses"
                >
                    <v-card-text>
                        <v-combobox
                            v-model="previewAddress"
                            item-title="name"
                            :items="indexAddresses"
                            label="Addresses"
                        />
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col
                cols="12"
                md="6"
            >
                <!-- New address -->
                <v-card
                    :loading="loading"
                    title="New Address"
                >
                    <v-card-text>
                        <v-text-field
                            v-model="newAddress.name"
                            label="Name"
                        />
                        <v-text-field
                            v-model="newAddress.street"
                            label="Address"
                        />
                        <v-text-field
                            v-model="newAddress.postalCode"
                            label="Zip"
                        />
                        <v-combobox
                            v-model="newAddress.cityId"
                            item-title="name"
                            item-value="id"
                            :items="indexCities"
                            label="City"
                            :return-object="false"
                        />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            color="primary"
                            @click="newAddress.onSuccess(fetchAddresses).save()"
                        >
                            Create
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
            <v-col
                cols="12"
                md="6"
            >
                <v-card
                    :loading="loading"
                    :title="`Preview Address - ${previewAddress.name}`"
                >
                    <v-card-text>
                        <!-- Display edit address -->
                        <v-text-field
                            v-model="previewAddress.name"
                            label="Name"
                        />
                        <v-text-field
                            v-model="previewAddress.street"
                            label="Address"
                        />
                        <v-text-field
                            v-model="previewAddress.postalCode"
                            label="Zip"
                        />
                        <v-combobox
                            v-model="previewAddress.cityId"
                            item-title="name"
                            item-value="id"
                            :items="indexCities"
                            label="City"
                            :return-object="false"
                        />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            color="primary"
                            @click="previewAddress.onSuccess(fetchAddresses).save()"
                        >
                            Update
                        </v-btn>
                        <v-btn
                            color="error"
                            @click="previewAddress.destroy()"
                        >
                            Delete
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card
                    :loading="loading"
                    title="All addresses"
                >
                    <v-data-table
                        :headers="[
                            {
                                title: 'Name',
                                key: 'name',
                            },
                            {
                                title: 'Address',
                                key: 'street',
                            },
                            {
                                title: 'Zip',
                                key: 'postalCode',
                            },
                            {
                                align: 'end',
                                title: 'City',
                                key: 'city.name',
                            },
                        ]"
                        :items="indexAddresses"
                        items-per-page="5"
                    />
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
    import Address from '../models/Address.js';
    import { onMounted, ref } from 'vue';
    import City from '../models/City.js';

    const loading = ref(true);

    const address = new Address();
    const city = new City();

    const newCity = ref(new City());
    const newAddress = ref(new Address());

    const previewCity = ref(new City());
    const previewAddress = ref(new Address());

    const indexAddresses = ref([]);
    const indexCities = ref([]);

    const fetchCities = async (data) => {
        loading.value = true;
        indexCities.value = await city.with('addresses').index();
        previewCity.value = data || new City();
        loading.value = false;
    };

    const fetchAddresses = async (data) => {
        loading.value = true;
        indexAddresses.value = await address.with('city').index();
        previewAddress.value = data || new Address();
        loading.value = false;
    };

    onMounted(async () => {
        previewAddress.value = (await address.with('city').show(1)) || new Address();

        previewCity.value = (await city.with('addresses').show(1)) || new City();

        indexAddresses.value = await address.with('city').index();
        indexCities.value = await city.with('addresses').index();

        loading.value = false;
    });
</script>
