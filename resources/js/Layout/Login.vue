<template>
    <v-app id="login">
        <v-main>
            <v-container
            class="py-8 px-6"
            fluid
            >
            <v-row>
                <v-col
                cols="12"
                class="d-flex justify-center"
                >
                <v-card width="500">
                    <slot></slot>
                </v-card>
                </v-col>
            </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>