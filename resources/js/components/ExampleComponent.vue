<template>
    <div class="example-component">
        <div class="card">
            <div class="card-header">Example Component</div>
            <div class="card-body">
                <p>This is an example component.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ExampleComponent",
    data() {
        return {
            message: "This is an example component.",
        };
    },
    methods: {
        // Ajoutez vos méthodes ici
    },
    computed: {
        // Ajoutez vos propriétés calculées ici
    },
};
</script>

<style scoped>
.example-component {
    /* Styles spécifiques au composant */
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
}
</style>
